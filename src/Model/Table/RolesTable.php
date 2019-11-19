<?php
namespace App\Model\Table;

use App\Model\Entity\Role;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Parts
 * @property \Cake\ORM\Association\BelongsToMany $People
 */
class RolesTable extends Table
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

        $this->setTable('roles');
        $this->setDisplayField('role');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Parts', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'part_id',
            'joinTable' => 'parts_roles'
        ]);
        $this->belongsToMany('People', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'person_id',
            'joinTable' => 'people_roles'
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
            ->allowEmpty('role');

        return $validator;
    }
}
