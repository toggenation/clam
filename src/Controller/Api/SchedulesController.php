<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * Description of SchedulesController
 *
 * @author jmcd
 */
class SchedulesController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 5,
        'maxLimit' => 15,
        'sortWhitelist' => [
            'id', 'name',
        ],
    ];

    public function initialize()
    {
        parent::initialize();
        //  $this->Auth->allow(['list']);
    }
    public function list() {
        $schedules = $this->Schedules->find()
            ->select(['id', 'start_date', 'end_date'])
            ->order(['start_date' => 'DESC']);

        $this->set(compact('schedules'));

        $this->set('_serialize', ['schedules']);

    }

    public function add()
    {
        $schedule = $this->Schedules->newEntity($this->request->getData());
        $success = $this->Schedules->save($schedule);
        if ($success) {
            $message = 'Saved';
            $success = true;
        } else {
            $message = $schedule->errors();
        }
        $this->set([
            'success' => $success,
            'message' => $message,
            'schedule' => $schedule,
            '_serialize' => ['message', 'success', 'schedule']
        ]);
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

      /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $message = 'The schedule could not be deleted. Please, try again.';
        $success = false;
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $message = 'The schedule has been deleted.';
            $success = true;
        }
        $this->set(compact('message', 'success'));
        $this->set('_serialize', [ 'message', 'success' ]);
    }

}
