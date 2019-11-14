<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Hash;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 */
class SchedulesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $find = $this->Schedules->find()
            ->order(['start_date' => 'desc']);
        $schedules = $this->paginate($find);
        $this->set(compact('schedules'));
        $this->set('_serialize', ['schedules']);
    }

    public function publishSchedule($id = null)
    {

        $schedule = $this->Schedules->get($id);

        if ($schedule->published === true) {

            $this->Flash->success("Schedule is already published");

        } else {

            $schedule->published = true;

            $result = $this->Schedules->save($schedule);

            if ($result) {
                $this->Flash->success("Schedule Published");
            } else {
                $this->Flash->error("Schedule could not be published");
            }
        }

        $this->redirect(['action' => 'schedule_print']);

    }

    public function toggleScheduled($id = null)
    {
        $schedule = $this->Schedules->get($id);

        $schedule->published = !($schedule->published === true);

        $this->Schedules->save($schedule);

        $this->redirect(['action' => 'schedule_print']);

    }

    public function editSchedule($schedule_id = null)
    {

        $people = $this->Schedules->Meetings->Assigned->People->find('list');

        $parts = $this->Schedules->Meetings->Assigned->Parts->find('all',
            ['condition' => [
                'active' => true,
            ],
                'order' => ['Parts.sort_order' => 'ASC'],
            ]);
        $schedule = $this->Schedules->get($schedule_id, [

            'contain' => [
                'Meetings' => [

                    'Assigned' => [
                        'People',
                        'Parts' => [
                            'Sections',
                        ],
                    ],

                ],

            ],
        ]);

        // $collection = new Collection($schedules);

        // $extract = $collection->extract('meetings.{*}.assigned.{*}.part.section.name');
        // $extract = $extract->toArray();

        //$schedule = $schedule->toArray();

        //$combine = $collection->combine('meetings.id', 'meetings.date')->toList();

        $this->set(compact('schedule', 'parts', 'people'));

    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['Meetings'],
        ]);

        $this->set('schedule', $schedule);
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEntity();

        if ($this->request->is('post')) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            $result = $this->Schedules->save($schedule);
            if ($result) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['controller' => 'meetings', 'action' => 'add-meetings', $result->id]);
            } else {
                if ($schedule->errors()) {
                    $error_msg = [];
                    foreach ($schedule->errors() as $errors) {
                        if (is_array($errors)) {
                            foreach ($errors as $error) {
                                $error_msg[$error] = $error;
                            }
                        } else {
                            $error_msg[] = $errors;
                        }
                    }

                    if (!empty($error_msg)) {
                        $this->Flash->error(
                            __("Please fix the following error(s): " . implode("\n \r", $error_msg))
                        );
                    }
                }
            }
        }

        $this->viewBuilder()->template('add2');

        $this->set(compact('schedule'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
            }
        }

        $months = cal_info(0);

        $months = Hash::combine($months['months'], '{n}', '{n}');

        $this->set(compact('schedule', 'months'));

        $this->set('_serialize', ['schedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('The schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'schedule_print']);
    }

    public function pdfView($schedule_id = null)
    {
        try {
            $schedule = $this->Schedules->get($schedule_id, [
                'contain' => [
                    'Meetings' => [
                        'sort' => ['Meetings.date' => 'ASC'],
                        'Chairmen',
                        'AuxiliaryCounselors',
                        'Assigned' => [
                            'sort' => ['Parts.sort_order' => 'ASC'],
                            'People',
                            'AuxAssigned',
                            'Assistants',
                            'AuxAssistants',
                            'Parts' => [

                                'Sections',
                            ],
                        ],
                        'MeetingNotes',
                    ],

                ],
                'order' => [
                    'start_date' => 'ASC',
                ],
            ]);
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {

            $this->Flash->error("Cannot find the record");
            return $this->redirect(['controller' => 'schedules', 'action' => 'schedule-print']);
        }

        $sections = $this->Schedules->Meetings->Assigned->Parts->Sections->find()
            ->order(['sort_order' => 'ASC']);



        $this->set(compact('schedule', 'sections'));
        $file_name = $schedule->full_year . '-' . $schedule->month_number . '_' . $schedule->short_month . '_CLM.pdf';
        $this->viewBuilder()->layout('ajax');
        $this->set('title', 'Christian Life and Ministry ' . $schedule->month . ' ' . $schedule->full_year);
        $this->set('file_name', $file_name);
        $this->response = $this->response->withType('pdf');

    }

    public function schedulePrint()
    {
        $schedulesFind = $this->Schedules->find('all')
            ->contain([
                'Meetings' => [
                    'Assigned' => [
                        'sort' => ['Parts.sort_order' => 'ASC'],
                        'Parts' => [

                            'Sections',
                        ],
                        'People',
                        'Assistants',
                    ],
                ],
            ]);

        $schedules = $this->paginate($schedulesFind, [
            'limit' => 10,
            'order' => [
                'start_date' => 'DESC',
            ],
        ]);

        /*
        $sections = $this->Schedules->Meetings->Assigned->Parts->Sections->find()
        ->order(['sort_order' => 'ASC']);
         */

        //debug($this->Auth->user('id'));
        $this->set(compact('schedules'));

    }

}
