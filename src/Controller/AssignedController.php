<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File;

/**
 * Assigned Controller
 *
 * @property \App\Model\Table\AssignedTable $Assigned
 */
class AssignedController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }


    public function scheduleEdit()
    {
        $file = new File(WWW_ROOT . '/react/asset-manifest.json');
        $manifest = json_decode($file->read());
        $file->close();
        //$this->log($manifest);
        $js = [];
        $css = [];

        foreach ($manifest->entrypoints as $key => $value) {
            if (preg_match('/\.js$/', $value) === 1) {
                $js[] = $value;
            }
            if (preg_match('/\.css$/', $value) === 1) {
                $css[] = $value;
            }
        }

        $this->set(compact('js', 'css'));
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parts', 'Meetings', 'People', 'Assistants'],
        ];
        $assigned = $this->paginate($this->Assigned);

        $this->set(compact('assigned'));
        $this->set('_serialize', ['assigned']);
    }

    /**
     * View method
     *
     * @param string|null $id Assigned id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assigned = $this->Assigned->get($id, [
            'contain' => ['Parts', 'Meetings', 'People'],
        ]);

        $this->set('assigned', $assigned);
        $this->set('_serialize', ['assigned']);
    }

    public function viewHistory($part_id = null, $assistant = false)
    {
        $assigned = $this->Assigned->findViewHistory($part_id, $assistant);

        $this->set('assigned', $assigned);
        $this->set('_serialize', ['assigned']);
    }

    public function saveSchedule()
    {
        if ($this->request->is('post')) {
            $assigned = \Cake\ORM\TableRegistry::get('Assigned');
            $entities = $assigned->newEntities($this->request->data['Assigned']);

            foreach ($entities as $entity) {
                if ($assigned->save($entity)) {
                    $this->Flash->success("Saved it baby {0}");
                } else {
                    // $this->log();
                    $errors = $entity->errors();

                    $slug = '';

                    foreach ($errors as $k => $v) {
                        foreach ($v as $w) {
                            $slug .= $w;
                        }
                    }
                    $this->Flash->error($slug);
                }
            }
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assigned = $this->Assigned->newEntity();
        if ($this->request->is('post')) {
            $assigned = $this->Assigned->patchEntity($assigned, $this->request->data);
            if ($this->Assigned->save($assigned)) {
                $this->Flash->success(__('The assigned has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assigned could not be saved. Please, try again.'));
            }
        }
        $parts = $this->Assigned->Parts->find('list', ['limit' => 200]);
        $meetings = $this->Assigned->Meetings->find('list', ['limit' => 200]);
        $people = $this->Assigned->People->find('list', ['limit' => 200]);
        $this->set(compact('assigned', 'parts', 'meetings', 'people'));
        $this->set('_serialize', ['assigned']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assigned id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assigned = $this->Assigned->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $assigned = $this->Assigned->patchEntity($assigned, $this->request->data);
            if ($this->Assigned->save($assigned)) {
                $this->Flash->success(__('The assigned has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assigned could not be saved. Please, try again.'));
            }
        }
        $parts = $this->Assigned->Parts->find('list', ['limit' => 200]);
        $meetings = $this->Assigned->Meetings->find('list', ['limit' => 200]);
        $people = $this->Assigned->People->find('list', ['limit' => 200]);
        $this->set(compact('assigned', 'parts', 'meetings', 'people'));
        $this->set('_serialize', ['assigned']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assigned id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assigned = $this->Assigned->get($id);
        if ($this->Assigned->delete($assigned)) {
            $this->Flash->success(__('The assigned has been deleted.'));
        } else {
            $this->Flash->error(__('The assigned could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function updateMeetingTimes($schedule_id = null)
    {

        // new query way of doing things
        $assigned = $this->Assigned->find()
            ->where([
                'Meetings.schedule_id' => $schedule_id,
                'Parts.active' => true,
            ])
            ->contain([
                'Meetings' => ['MeetingNotes'],
                'Parts',

            ])->order([
                'Meetings.date' => 'ASC',
                'Parts.sort_order' => 'ASC',
            ]);

        $this->set('assigned', $assigned);
    }





    public function editAssignments($schedule_id = null)
    {

        // new query way of doing things
        $assigned = $this->Assigned->find()
            ->where([
                'Meetings.schedule_id' => $schedule_id,
                'Parts.active' => true,
            ])
            ->contain([
                'Meetings' => ['MeetingNotes'],
                'Parts',

            ])->order([
                'Meetings.date' => 'ASC',
                'Parts.sort_order' => 'ASC',
            ]);

        $meetingChairmen = $this->Assigned->findMeetingPrivs('Chairman');

        $auxCounselors = $this->Assigned->findMeetingPrivs('Auxiliary Classroom Counselor');

        $roles = $this->Assigned->find_privs();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $meetings = $this->Assigned->Meetings;
            foreach ($this->request->data['Meetings'] as $mtg) {
                if ($mtg['co_visit']) {
                    if (!$this->Assigned->hasCoPart($mtg['id'])) {
                        $this->Assigned->addCoParts($mtg['id']);
                    }
                }

                $meeting = $this->Assigned->Meetings->get($mtg['id']);

                $entity = $meetings->patchEntity($meeting, $mtg);

                $result = $meetings->save($entity);
            }

            if (isset($this->request->data['Assigned'])) {
                $collection = new Collection($this->request->data['Assigned']);

                $result = $this->Assigned->doUpdates($collection, $assigned);

                if ($result) {
                    $this->Flash->success("Successfully saved assignments");
                } else {
                    $this->Flash->error("An error occurred while saving assignments");
                }

                $entitiesWithUpdates = $this->Assigned->addChairmanToParts($this->request->data['Assigned'], $this->request->data['Meetings']);

                $deleteResult = $this->Assigned->doDeletes($collection);

                if ($deleteResult['result']) {
                    $this->Flash->success($deleteResult['txt']);
                }
            }
            return $this->redirect(['action' => 'edit-assignments', $schedule_id]);
        } else {
            if (empty($schedule_id)) {
                $this->Flash->error("Specify a Schedule to edit");
                //return $this->redirect(['action' => 'index']);
            }

            $meetings = $this->Assigned->Meetings->find()
                ->where(
                    [
                        'Meetings.schedule_id' => $schedule_id,
                    ]
                )
                ->contain([
                    'MeetingNotes',
                    'Assigned' => [

                        'strategy' => 'subquery',
                        'queryBuilder' => function ($q) {
                            return $q
                                ->where(['Parts.active' => true])
                                ->contain(['Parts' => ['Sections']])
                                ->order(['Parts.sort_order' => 'ASC']);
                        },
                    ],
                ])
                ->order(['date' => 'ASC']);

            $schedule = $this->Assigned->Meetings->Schedules->get($schedule_id);

            if ($schedule->published) {
                $this->Flash->error(__('{0} schedule is already published. Edit the schedule and uncheck "Published" to allow editing', $schedule->range));
                $this->redirect(['controller' => 'schedules', 'action' => 'schedule_print']);
            }

            $month = $schedule->month;

            $this->set(
                compact(
                    'meetingChairmen',
                    'auxCounselors',
                    'roles',
                    'assigned',
                    'meetings',
                    'month',
                    'schedule_id'
                )
            );
        }
    }

    /**
     *
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addEdit()
    {
        $schedules = $this->Assigned->Meetings->Schedules->find()
            ->order(['start_date' => 'ASC']);

        $this->set(compact('schedules'));
    }

    public function addAssignments($schedule_id = null, $meeting_id = null)
    {
        if ($meeting_id === null) {
            $this->Flash->error("You need to add meetings");
            return $this->redirect([
                'controller' => "Meetings",
                'action' => 'addMeetings', $schedule_id
            ]);
        }

        $partsQuery = $this->Assigned->Parts->find()
            ->select([
                'meeting_id' => $meeting_id,
                'part_id' => 'id',
                'part_title' => 'partname',
                'minutes',
                'start_time',
            ])
            ->where([
                'active' => 1,
                'co_visit' => 0,
            ])->order([
                'sort_order' => 'ASC',
            ]);

        $partsWithFormattedDate = $partsQuery->map(function ($value, $key) {
            $hms = new \DateTime($value->start_time);
            $value->start_time = $hms->format('H:i:s');
            return $value;
        });

        // this causes a problem if there is a meeting missing
        //                if ($assigned->count() > 0) {
        //                    return $this->redirect(['controller' => 'assigned', 'action' => 'edit-assignments', $schedule_id]);
        //                }

        if ($this->request->is(['patch', 'post', 'put'])) {

            //$this->log($this->request->data['Assigned']);
            $parts_array = json_decode(json_encode($partsWithFormattedDate), true);
            //    $this->log([ 'PART_ARRAY' => $parts_array]);
            $entities = $this->Assigned->newEntities($parts_array);

            $result = $this->Assigned->saveMany($entities);
            if ($result) {
                $this->Flash->success("Added parts to meeting");
            } else {
                $this->Flash->error("Failed to add parts to meeting");
            }
            return $this->redirect(['action' => 'edit-assignments', $schedule_id]);
        } else {
            if (empty($schedule_id)) {
                $this->Flash->error("Specify a Schedule to edit");
                return $this->redirect(['action' => 'add-edit']);
            }
        }
    }
}
