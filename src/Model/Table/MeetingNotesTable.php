<?php
namespace App\Model\Table;

use App\Model\Entity\MeetingNote;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

/**
 * MeetingNotes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Meetings
 */
class MeetingNotesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('meeting_notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Meetings', [
            'foreignKey' => 'meeting_id',
            'joinType' => 'INNER'
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
            ->requirePresence('note', 'create')
            ->notEmpty('note');

        $validator
            ->requirePresence('heading', 'create')
            ->notEmpty('heading');

        return $validator;
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
        $rules->add($rules->isUnique(['meeting_id'], [
            'message' => "Meeting note for this meeting already exists. You can only add one note per meeting"
        ]));
        $rules->add($rules->existsIn(['meeting_id'], 'Meetings'));
        return $rules;
    }
}
