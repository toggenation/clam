<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Api;

use App\Controller\Api\AppController;
//use Cake\Http\Exception\NotFoundException;
use App\Exception\TgnNotFoundException;
use Cake\Utility\Hash;

/**
 * Description of SchedulesController
 *
 * @author jmcd
 */
class AssignedController extends AppController
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
     * method initialize
     *  */
    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['getPrivs']);
    }

    public function getPrivs()
    {
        $roles = $this->Assigned->findPrivsApi();
        $meetingChairmen = $this->Assigned->findAPIMeetingPrivs('Chairman');
        $auxCounselors = $this->Assigned->findAPIMeetingPrivs('Auxiliary Classroom Counselor');
        $this->set(compact('meetingChairmen', 'auxCounselors'));
        $this->set('privs', $roles);
        $this->set('_serialize', ['privs', 'meetingChairmen', 'auxCounselors']);
    }

    public function loadSchedule($schedule_id = null)
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

        if ($assigned->isEmpty()) {
           // throw new TgnNotFoundException('Schedule ID missing or incorrect');
            /*$this->response = $this->response->withType('application/json')
                ->withStringBody(
                    json_encode(['result' => 'error', 'success' => false, 'message' => "Missing schedule id"])
                );
            return $this->response;*/

        }

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

            $month = $schedule->month;

            $this->set(
                compact(
                    'schedule',
                    'meetingChairmen',
                    'auxCounselors',
                    'roles',
                    'assigned',
                    'meetings',
                    'month',
                    'schedule_id'
                )
            );

            $this->set(
                '_serialize',
                true
            );
        }
    }
    /**
     * method saveAssignedParts
     * takes array of parts and either creates new items or
     * edits them
     */
    public function addAssignedParts()
    {
        $success = false;

        if ($this->request->is(['POST', 'PUT'])) {
            $data = $this->request->data;
            $entities = $this->Assigned->newEntities($data);
            $result = $this->Assigned->saveMany($entities);
            $this->log($data);
            if ($result) {
                $success = true;
            }
            $this->set(compact('result', 'success'));
            $this->set('_serialize', ['result', 'success']);
        }
    }

    public function editAssignedParts()
    {
        $success = false;

        if ($this->request->is(['POST', 'PUT'])) {
            $entityData = $this->request->getData();

            $entityIds = Hash::extract($entityData, '{n}.id');
            $toPatch = $this->Assigned->find()->where(['id IN' => $entityIds]);

            $assigned = $this->Assigned;
            $entities = $assigned->patchEntities($toPatch, $entityData);
            $result = $assigned->saveMany($entities);

            // $this->log($data);
            if ($result) {
                $success = true;
            }
            $this->set(compact('success', 'result'));
            $this->set('_serialize', ['result', 'success']);

        }
    }

}
