<?php

namespace App\Model\Table;

use App\Model\Entity\Meeting;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use Cake\Log\LogTrait;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
/**
 * Meetings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schedules
 * @property \Cake\ORM\Association\HasMany $Assigned
 */
class MeetingsTable extends Table {

    use LogTrait;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('meetings');
        $this->setDisplayField('date');
        $this->setPrimaryKey('id');


				$this->belongsTo('AuxiliaryCounselors', [
						'className' => "People",
            'foreignKey' => 'auxiliary_counselor_id',
        ]);

        $this->belongsTo('Schedules', [
            'foreignKey' => 'schedule_id',
            'joinType' => 'INNER'
        ]);

				$this->belongsTo('People', [
            'foreignKey' => 'person_id'
        ]);

        $this->belongsTo('Chairmen', [
					  'className' => "People",
            'foreignKey' => 'person_id'
        ]);

        $this->hasMany('Assigned', [
            'dependent' => true,
            'foreignKey' => 'meeting_id',
            'cascadeCallbacks' => true
        ]);

        $this->hasOne('MeetingNotes', [
            'dependent' => true,
            'foreignKey' => 'meeting_id',
            'cascadeCallbacks' => true
        ]);
    }



		public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
		{


		}
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
        $validator->add('date', 'custom', [
           'rule' => [ $this, 'checkDates'],
           'message' => 'Dates outside of schedule dates'
        ]);
        $validator
            ->date('date')
            ->add('date', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => "One of the meeting dates you submitted already exists!",
                'on' => 'create'
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['schedule_id'], 'Schedules'));
        $rules->add($rules->isUnique(['date']));
        return $rules;
    }

    function checkDates($check, $context = []){
        //$this->log([ 'check' => $check, 'context' => $context]);
        if (is_array($check)){
            $check_value = $check['year'] . '-' . $check['month'] . '-' . $check['day'];
        } else {
            $check_value = $check;
        }

        $overlap = $this->Schedules->find()
                    ->where([
                        'id' => $context['data']['schedule_id'],
                        '"' . $check_value . '" >= start_date',
                        '"' . $check_value . '" <= end_date'
                        ])->count();

        return $overlap === 1;

    }

    public function getParts($week_number = null) {


        $part_table = \Cake\ORM\TableRegistry::get('Parts');

        $parts = $part_table->find()
                        ->select([
                            'part_id' => 'id',
                            'start_time',
                            'minutes',
                            'part_title' => 'partname'
                        ])
                        ->where([
                            'active' => true,
                            'co_visit' => 0,
                            /* no longer skipping parts as of Jan 2018
														'NOT' => [
                                'id IN' => $this->getPartIdsToSkip($week_number)
                                ]
																*/
                        ])->order(
                ['sort_order' => 'ASC']
        );

        $ret = $this->formatParts($parts);

        return $ret;
    }

    function formatParts($parts) {
        return Hash::map($parts->toArray(), '{n}', [$this, 'formatArray']);
    }

    function formatArray($data) {
        return [
            'part_id' => $data->part_id,
            'start_time' => $data->start_time,
            'minutes' => $data->minutes,
            'part_title' => $data->part_title
        ];
    }

    function sortAndFormatDates($dates, $schedule_id) {

        foreach ($dates as $date) {

            $ymd = \DateTime::createFromFormat('!d/m/Y', $date)->format('Y-m-d');

            $data[] = [
                'date' => $ymd,
                'schedule_id' => $schedule_id
            ];

        };

        usort($data, [$this, 'sortFunction']);
        return $data;
    }

    public function sortFunction($a, $b) {
        return strtotime($a["date"]) - strtotime($b["date"]);
    }

}
