<?php
namespace App\Model\Table;

use App\Model\Entity\PartsPrivilege;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PartsPrivileges Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Parts
 * @property \Cake\ORM\Association\BelongsTo $Privileges
 */
class PartsPrivilegesTable extends Table
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

        $this->setTable('parts_privileges');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Parts', [
            'foreignKey' => 'part_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Privileges', [
            'foreignKey' => 'privilege_id',
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
        $rules->add($rules->existsIn(['part_id'], 'Parts'));
        $rules->add($rules->existsIn(['privilege_id'], 'Privileges'));
        return $rules;
    }
}
