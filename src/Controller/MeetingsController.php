<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Text;

/**
 * Meetings Controller
 *
 * @property \App\Model\Table\MeetingsTable $Meetings
 */
class MeetingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schedules', 'People', 'AuxiliaryCounselors', 'Chairmen'],
        ];
        $meetings = $this->paginate($this->Meetings);

        $this->set(compact('meetings'));
        $this->set('_serialize', ['meetings']);
    }

    /**
     * View method
     *
     * @param string|null $id Meeting id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $meeting = $this->Meetings->get($id, [
            'contain' => ['Schedules', 'AuxiliaryCounselors', 'Chairmen', 'Assigned' => ['People', 'Assistants']],
        ]);

        $this->set('meeting', $meeting);
        $this->set('_serialize', ['meeting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $meeting = $this->Meetings->newEntity();
        if ($this->request->is('post')) {
            $meeting = $this->Meetings->patchEntity($meeting, $this->request->data);
            if ($this->Meetings->save($meeting)) {
                $this->Flash->success(__('The meeting has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meeting could not be saved. Please, try again.'));
            }
        }
        $schedules = $this->Meetings->Schedules->find('list', [
            'keyField' => 'id',
            'valueField' => function ($schedule) {
                return $schedule->get('MonthYear');
            },
            'order' => [
                'start_date' => 'DESC',
            ],
            'limit' => 200]);
        $this->set(compact('meeting', 'schedules'));
        $this->set('_serialize', ['meeting']);
    }

    public function addMeetings($schedule_id = null)
    {
        if ($this->request->is('post')) {

            if (!empty($this->request->data['meeting_dates'])) {
                $dates = explode(',', $this->request->data['meeting_dates']);
                $schedule_id = $this->request->data['schedule_id'];

                $dates_data = $this->Meetings->sortAndFormatDates($dates, $schedule_id);

                $meetings_already = $this->Meetings->find()->where(['schedule_id' => $schedule_id])->count();

                foreach ($dates_data as $week_num => $data) {

                    $dates_data[$week_num]['assigned'] = $this->Meetings->getParts($week_num);

                }

                $entities = $this->Meetings->newEntities($dates_data, [
                    'associated' => ['Assigned'],
                ]);

                foreach ($entities as $entity) {
                    if ($entity->errors()) {
                        $error_msg = [];

                        foreach ($entity->errors() as $errors) {
                            if (is_array($errors)) {
                                foreach ($errors as $error) {
                                    $error_msg[] = $error;
                                }
                            } else {
                                $error_msg[] = $errors;
                            }
                        }

                        if (!empty($error_msg)) {
                            $this->Flash->error(
                                __("Please fix the following error(s): " . Text::toList($error_msg))
                            );

                            return $this->redirect(['action' => 'add-meetings', $schedule_id]);
                        }
                    };
                }

                if ($this->Meetings->saveMany($entities)) {
                    $this->Flash->success("Saved meetings and added the parts");
                } else {
                    $this->Flash->error("Failed to save meetings and parts");

                    return $this->redirect(['action' => 'add-meetings', $schedule_id]);
                }

                return $this->redirect(['controller' => 'assigned', 'action' => 'edit-assignments', $schedule_id]);
            }
        } // end post block
        if (empty($schedule_id)) {
            throw new NotFoundException('Missing schedule ID');
        }

        $schedule = $this->Meetings->Schedules->get($schedule_id);

        $this->request->data = ['schedule_id' => $schedule_id];
        //$schedules = $this->Meetings->Schedules->find()->where(['published' => 0]);

        // $schedules = $schedules->combine('id', 'range');

        $this->set(compact('schedule'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Meeting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $meeting = $this->Meetings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $meeting = $this->Meetings->patchEntity($meeting, $this->request->data);
            if ($this->Meetings->save($meeting)) {
                $this->Flash->success(__('The meeting has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meeting could not be saved. Please, try again.'));
            }
        }
        $schedules = $this->Meetings->Schedules->find('list', ['limit' => 200]);
        $this->set(compact('meeting', 'schedules'));
        $this->set('_serialize', ['meeting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meeting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $meeting = $this->Meetings->get($id);
        if ($this->Meetings->delete($meeting)) {
            $this->Flash->success(__('The meeting has been deleted.'));
        } else {
            $this->Flash->error(__('The meeting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
