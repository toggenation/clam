<?php
namespace App\Model\Table;

use App\Model\Entity\Person;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * People Model
 *
 * @property \Cake\ORM\Association\HasMany $Assigned
 * @property \Cake\ORM\Association\BelongsToMany $Privileges
 */
class PeopleTable extends Table
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

        $this->getTable('people');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users');

        $this->hasMany('Assigned', [
            'foreignKey' => 'person_id'
        ]);
				$this->hasMany('Meetings', [
            'foreignKey' => 'person_id'
        ]);
				$this->hasMany('Chairmen', [
						'className' => 'Meetings',
						'foreignKey' => 'person_id'
				]);

				$this->hasMany('AuxiliaryCounselors', [
					  'className' => 'Meetings',
            'foreignKey' => 'auxiliary_counselor_id'
        ]);
				$this->hasMany('AuxAssigned', [
						'className' => 'Assigned',
						'foreignKey' => 'aux_person_id'
				]);

        $this->hasMany('Assistants', [
            'className' => 'Assigned',
            'foreignKey' => 'assistant_id'
        ]);

				$this->hasMany('AuxAssistants', [
            'className' => 'Assigned',
            'foreignKey' => 'aux_assistant_id'
        ]);

        $this->belongsToMany('Privileges', [
            'foreignKey' => 'person_id',
            'targetForeignKey' => 'privilege_id',
            'joinTable' => 'people_privileges'
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

       /* $validator
            ->allowEmpty('firstname');

        $validator
            ->allowEmpty('lastname');
            */

        return $validator;
    }


// ...

public function buildRules(RulesChecker $rules)
{
    $rules->add($rules->isUnique(['firstname', 'lastname'],

            [
                'message' => 'Duplicate person (same first and last name) detected, please edit the existing user'
                ]));

    return $rules;
}

public function getAssignments($schedule_id, $sort = 'DESC'){
   //debug($this->connection()->config());

   $connection = ConnectionManager::get($this->connection()->config()['name']);

   $qry = 'SELECT COUNT(u.p1) AS parts,
       u.p1 as id,
       u.firstname,
       u.lastname,
       u.id as schedule_id
FROM
    (SELECT a.person_id AS p1,
            p.firstname,
            p.lastname,
            s.id
     FROM assigned a
     INNER JOIN meetings m ON a.meeting_id = m.id
     INNER JOIN schedules s ON m.schedule_id = s.id
     INNER JOIN people p ON a.person_id = p.id
     WHERE s.id = ? AND a.part_id <> 16
         UNION ALL
         SELECT a.assistant_id AS p1,
                p.firstname,
                p.lastname,
                s.id
         FROM assigned a
         INNER JOIN meetings m ON a.meeting_id = m.id
         INNER JOIN schedules s ON m.schedule_id = s.id
         INNER JOIN people p ON a.assistant_id = p.id
         WHERE s.id = ? AND a.part_id <> 16 ) AS u
GROUP BY u.p1
ORDER BY parts ' . $sort . ', u.firstname;';

   return $connection->execute(
           $qry,
           [ $schedule_id, $schedule_id]

           );
}

 public function getPeopleWithIcon(){
    $people = $this->find('all', ['limit' => 200])
    ->order(['People.firstname' => 'ASC', 'People.lastname' => 'ASC']);
    return $people
    ->combine(
        'id',
        function ($entity) {
            $iconName = $entity->brother ? 'fa-male' : 'fa-female';
            $icon = sprintf('<i class="fas %s"></i>', $iconName);
            $fullName = $icon . ' ' . $entity->full_name;
            return $fullName;
        }
    );
 }

}
