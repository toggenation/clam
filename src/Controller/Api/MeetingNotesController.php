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
class MeetingNotesController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 5,
        'maxLimit' => 15,
        'sortWhitelist' => [
            'id', 'name',
        ],
    ];

    public function mnSaveMany()
    {
        if ($this->request->is(["PUT", "POST"])) {
            $entityData = $this->request->getData();

            $entityIds = Hash::extract($entityData, '{n}.id');

            $toPatch = $this->MeetingNotes->find()->where(['id IN' => $entityIds]);

            $meetingNotes = $this->MeetingNotes;
            $entities = $meetingNotes->patchEntities($toPatch, $entityData);
            $result = $meetingNotes->saveMany($entities);

            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }
}
