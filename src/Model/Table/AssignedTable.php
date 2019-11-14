<?php

namespace App\Model\Table;

use App\Model\Entity\Assigned;
use Cake\Collection\Collection;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker; // for find_privs()
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Assigned Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Parts
 * @property \Cake\ORM\Association\BelongsTo $Meetings
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Assistants
 */

class AssignedTable extends Table
{
    use \Cake\Log\LogTrait;

    /*
    public function beforeSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {


    }
    */
    public function doUpdates($collection = null, $assigned)
    {

        $updates = $collection
            ->filter(
                function ($assignment, $key) {
                    return !(bool)$assignment['remove'];
                }
            )->toArray();

        $entities = $this->patchEntities($assigned, $updates);

        return $this->saveMany($entities);

    }

    public function doDeletes($collection)
    {
        $deletes = $collection
            ->filter(function ($assignment, $key) {
                //$this->log(['Assigned' => $assignment]);
                return (bool)$assignment['remove'];
            })->extract('id')->toArray();
        $count = [];
        if (!empty($deletes)) {
            foreach ($deletes as $k => $delete) {
                $entity = $this->get($delete);
                $count[] = $this->delete($entity);
            }
            $result = true;
            $txt = count($count) . ' parts deleted';
        } else {
            $result = false;
        }

        return ['result' => $result, 'txt' => $txt];

    }
    public function addChairmanToParts($assigned = [], $meetings = [])
    {

        $parts = TableRegistry::get("Parts");

        $items = $parts->find()
            ->select(['id'])
            ->where([
                'active' => 1,
                'chairman_part' => 1,
            ]);

        $part_ids = (new Collection($items))->extract('id')->toArray();

        foreach ($meetings as $key => $meeting) {

            $meeting_id = $meeting['id'];
            $chairman = $meeting['person_id'];

            $this->query()
                ->update()
                ->set([
                    'person_id' => $chairman,
                ])
                ->where([
                    'meeting_id' => $meeting_id,
                    'part_id IN' => $part_ids,
                ])
                ->execute();

        }

    }
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {

        /* this replaces song numbers via a replace string */

        if (!empty($data['replace_token']) && !empty($data['replace_token_value'])) {
            $data['part_title'] = str_replace($data['replace_token'], $data['replace_token_value'], $data['part_title']);
        }
    }

    public function hasCoPart($meeting_id)
    {
        $assigned = $this->find()
            ->matching(
                'Parts',
                function ($q) {
                    return $q->where(['co_visit' => 1]);
                }
            )->where(
            [
                'meeting_id' => $meeting_id,
            ]
        )->count();

        return $assigned !== 0;
    }

    public function addCoParts($meeting_id)
    {
        $this->meeting_id = $meeting_id;

        $parts = $this->Parts->find()
            ->select([
                'part_id' => 'id',
                'start_time',
                'minutes',
                'part_title' => 'partname',
            ])
            ->where([
                'active' => true,
                'co_visit' => true,
            ]);

        $formattedParts = $this->formatParts($parts);
        foreach ($formattedParts as $part) {
            $assigned = $this->newEntity();
            $assigned = $this->patchEntity($assigned, $part);
            $this->save($assigned);
        }
    }


    public function findAPIMeetingPrivs($priv_name = null)
    {
        $meetingPrivs = $this->Parts->Privileges->find()
            ->contain(
                "People", function ($q) {
                    return $q->select(
                        [
                            'id',
                            'gfull_name' => $q->func()->concat(
                                [
                                    'firstname' => 'literal',
                                    ' ',
                                    'lastname' => 'literal',
                                ]
                            ),
                        ])->where(['People.active' => true])->order([ 'People.firstname' => 'ASC']);
                }
            )
            ->where(['privilege' => $priv_name])->first();
        $people = $meetingPrivs->toArray();

        $people = $people['people'];
        $items = new Collection($people);

        $meetingPrivs = $items->map(function( $value, $key){
            return [
                'id' => $value['id'],
                'name' => $value['gfull_name']
            ];
        });
        //$this->log($meetingPrivs);

        return $meetingPrivs;

    }

    public function findMeetingPrivs($priv_name = null)
    {
        $meetingPrivs = $this->Parts->Privileges->find()
            ->contain(
                "People", function ($q) {
                    return $q->select(
                        [
                            'id',
                            'gfull_name' => $q->func()->concat(
                                [
                                    'firstname' => 'literal',
                                    ' ',
                                    'lastname' => 'literal',
                                ]
                            ),
                        ])->where(['People.active' => true])->order([ 'People.firstname' => 'ASC']);
                }
            )
            ->where(['privilege' => $priv_name])->first();
        $people = $meetingPrivs->toArray();

        $people = $people['people'];
        $items = new Collection($people);

        $meetingPrivs = $items->combine('id', 'gfull_name');
       // $this->log($meetingPrivs);

        return $meetingPrivs;

    }
    public function formatParts($parts)
    {
        return Hash::map($parts->toArray(), '{n}', [$this, 'formatArray']);
    }

    public function formatArray($data)
    {
        return [
            'part_id' => $data->part_id,
            'start_time' => $data->start_time,
            'minutes' => $data->minutes,
            'part_title' => $data->part_title,
            'meeting_id' => $this->meeting_id,
        ];
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('assigned');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Parts', [
            'foreignKey' => 'part_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Meetings', [
            'foreignKey' => 'meeting_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('People', [
            'foreignKey' => 'person_id',
        ]);
        $this->belongsTo('Assistants', [
            'className' => 'People',
            'foreignKey' => 'assistant_id',
        ]);

        $this->belongsTo('AuxAssistants', [
            'className' => 'People',
            'foreignKey' => 'aux_assistant_id',
        ]);
        $this->belongsTo('AuxAssigned', [
            'className' => 'People',
            'foreignKey' => 'aux_person_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('minutes')
            ->requirePresence('minutes', 'create')
            ->notEmpty('minutes');

        $validator
            ->requirePresence('part_title', 'create')
            ->notEmpty('part_title');

        $validator->add('part_id', 'custom', [
            'on' => function ($context) {
                return $context['newRecord'] && isset($context['data']['meeting_id']);
            },
            'message' => "Record already exists",
            'rule' => function ($value, $context) {
                //$this->log([ 'value' => $value, 'context' => $context]);
                $data = $context['data'];
                $meeting_id = $data['meeting_id'];

                $count = $this->find('all', [
                    'conditions' => [
                        'meeting_id' => $meeting_id,
                        'part_id' => $value, // part_id
                    ],
                ]);
                return $count->count() == 0;
            },
        ]);

        return $validator;
    }

    public function get_schedules($limit = 2)
    {
        return $this->Meetings->Schedules->find('all')
            ->order(['start_date' => "DESC"])->limit($limit);
    }

    public function findViewHistory($part_id = null, $assistant = false)
    {
        if ((int)$assistant === 1) {
            $person_assistant = 'assistant_id';
            $select_params = [
                'Assistants.firstname' => 'literal',
                ' ',
                'Assistants.lastname' => 'literal',
                ' &mdash; ',
                'DATE_FORMAT(Meetings.date, "%d/%m/%y")' => 'literal',
            ];
        } else {
            $person_assistant = 'person_id';
            $select_params = [
                'People.firstname' => 'literal',
                ' ',
                'People.lastname' => 'literal',
                ' &mdash; ',
                'DATE_FORMAT(Meetings.date, "%d/%m/%y")' => 'literal',
            ];
        }

        $query = $this->find();

        $fullname = $query->func()->concat($select_params);

        $values = $query->select([
            'fullname' => $fullname,
            'meetingdate' => 'Meetings.date',
            'assign_to' =>
            'Assigned.' . $person_assistant,
            'unixtimestamp' => 'UNIX_TIMESTAMP(Meetings.date)',
        ])
            ->contain(['Parts', 'Meetings', 'People' => function ($q) {
                return $q->where(['People.active' => 1]);
            }, 'Assistants'])
            ->where(['part_id' => $part_id])
            ->where(['Assigned.' . $person_assistant . ' IS NOT' => null])
            ->order(['Meetings.date' => 'DESC'])
            ->limit(16);

        $assigned = $values->sortBy('unixtimestamp', SORT_ASC);

        $assigned = $assigned->toArray(false);

        for ($i = 0; $i < count($assigned); $i++) {
            $assigned[$i]['target-field'] = $person_assistant;
        }

        return $assigned;
    }

    public function find_privs()
    {
        $people_privileges = $this->Parts->find()
            ->contain([
                'Privileges',
                'Privileges.People' => function ($q) {
                    return $q->select(['id', 'firstname', 'lastname'])
                        ->where(['People.active' => true])
                        ->order([
                            'firstname' => 'ASC',
                            'lastname' => 'ASC',
                        ]);
                },
            ])
            ->where(["Parts.active" => true]);

        //$this->log(['peoplePrivs' => $people_privileges->toArray()]);
        $ret = $people_privileges->map(function ($value, $key) {
            $part_id = $value->id;

            $pplr = [
                'assistant' => false,
                'assigned' => false,
            ];
            $ppla = Hash::extract($value, 'privileges');

            //$this->log(['ppla' => $ppla]);
            foreach ($ppla as $pp) {
                if ($pp['assistant']) {
                    $pplr['assistant'] = Hash::combine($pp['people'], '{n}.id', ['%s %s', '{n}.firstname', '{n}.lastname']);
                } else {
                    $pplr['assigned'] = Hash::combine($pp['people'], '{n}.id', ['%s %s', '{n}.firstname', '{n}.lastname']);
                }
            }

            return [$part_id => $pplr]
            ;
        }); // end map

        $privileges = [];
        foreach ($ret as $r) {
            $privileges += $r;
        }

        return $privileges;
    }

    public function findPrivsApi()
    {
        $people_privileges = $this->Parts->find()
            ->contain([
                'Privileges',
                'Privileges.People' => function ($q) {
                    return $q->select(['id', 'firstname', 'lastname'])
                        ->where(['People.active' => true])
                        ->order([
                            'firstname' => 'ASC',
                            'lastname' => 'ASC',
                        ]);
                },
            ])
            ->where(["Parts.active" => true]);

        //$this->log(['peoplePrivs' => $people_privileges->toArray()]);
        $ret = $people_privileges->map(function ($value, $key) {
            $part_id = $value->id;
            $partName = $value->partname;
            $brother = $value->brother;
            $chairman_part = $value->chairman_part;
            $school_part = $value->school_part;
            $assistant = $value->assistant;
            $has_auxiliary = $value->has_auxiliary;

            $pplr = [
                'assistant' => false,
                'assigned' => false,
            ];
            $ppla = Hash::extract($value, 'privileges');

            //$this->log(['ppla' => $ppla]);
            foreach ($ppla as $pp) {
                if ($pp['assistant']) {

                    $assistant = Hash::combine(
                        $pp['people'],
                        '{n}.id',
                        ['%s %s', '{n}.firstname', '{n}.lastname']
                    );

                    $pplr['assistant'] = $assistant;
                    $pplr['assistantsById'] = Hash::extract($pp['people'], '{n}.id');

                } else {
                    $pplr['assigned'] = Hash::combine($pp['people'], '{n}.id', ['%s %s', '{n}.firstname', '{n}.lastname']);
                    $pplr['assignedById'] = Hash::extract($pp['people'], '{n}.id');
                }
            }

            return [
                $part_id => [
                    'id' => $part_id,
                    'partName' => $partName,
                    'brother' => $brother,
                    'assistant' => $assistant,
                    'chairman_part' => $chairman_part,
                    'has_auxiliary' => $has_auxiliary,
                    'school_part' => $school_part

                ] + $pplr
            ];
        }); // end map

        $privileges = [];
        foreach ($ret as $r) {
            $privileges += $r;
        }

        return $privileges;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
//        $check = function($assigned, $options){
        //                $this->log([
        //                    'options' => $options,
        //                    'assignedclam' => $assigned]);
        //                 $count = $this->find('all', [
        //                    'conditions' => [
        //                        'meeting_id' => $assigned->meeting_id,
        //                        'part_id' => $assigned->part_id // part_id
        //                    ]
        //                ]);
        //
        //
        //              return $count->count() == 0;
        //
        //        };
        //
        $rules->add($rules->existsIn(['part_id'], 'Parts'));
        $rules->add($rules->existsIn(['meeting_id'], 'Meetings'));
        $rules->add($rules->existsIn(['person_id'], 'People'));
        $rules->add($rules->existsIn(['assistant_id'], 'Assistants'));
        $rules->add($rules->existsIn(['aux_person_id'], 'People'));
        $rules->add($rules->existsIn(['aux_assistant_id'], 'Assistants'));
//        $rules->add($check, [
        //            'errorField' => 'part_id' ,
        //            'message' => "Part already exists for the meeting"
        //        ]);
        return $rules;
    }
}
