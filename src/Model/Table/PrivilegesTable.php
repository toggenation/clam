<?php
namespace App\Model\Table;

use App\Model\Entity\Privilege;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Privileges Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Parts
 * @property \Cake\ORM\Association\BelongsToMany $People
 */
class PrivilegesTable extends Table
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

        $this->setTable('privileges');
        $this->setDisplayField('privilege');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Parts', [
            'foreignKey' => 'privilege_id',
            'targetForeignKey' => 'part_id',
            'joinTable' => 'parts_privileges'
        ]);
        $this->belongsToMany('People', [
            'foreignKey' => 'privilege_id',
            'targetForeignKey' => 'person_id',
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

        $validator
            ->allowEmpty('privilege');

        return $validator;
    }
}
