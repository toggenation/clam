<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Utility\Hash;

/**
 * Description of SchedulesController
 *
 * @author jmcd
 */
class MeetingsController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 5,
        'maxLimit' => 15,
        'sortWhitelist' => [
            'id', 'name',
        ],
    ];
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $meeting = $this->Meetings->newEntity();
        if ($this->request->is([ 'PUT', 'POST'])) {
            $meeting = $this->Meetings->patchEntity($meeting, $this->request->data);
            if ($this->Meetings->save($meeting)) {
                $success = true;
                $data = $meeting;
                $error = '';
            } else {
                $success = false;
                $error = $meeting->errors();
                $data = $meeting;
            }
        }

        $this->set(compact('meeting', 'success', 'error'));
        $this->set('_serialize', ['meeting', 'success', 'error']);
    }

    /**
     * saveMeetings
     * @return void
     */
    public function saveMeetings()
    {
        if ($this->request->is(["PUT", "POST"])) {
            $entityData = $this->request->getData();

            $entityIds = Hash::extract($entityData, '{n}.id');

            $toPatch = $this->Meetings->find()->where(['id IN' => $entityIds]);

            $meetings = $this->Meetings;
            $entities = $meetings->patchEntities($toPatch, $entityData);
            $result = $meetings->saveMany($entities);

            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }
}
