<?php
namespace App\Model\Table;

use App\Model\Entity\Part;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sections
 * @property \Cake\ORM\Association\HasMany $Assigned
 * @property \Cake\ORM\Association\BelongsToMany $Roles
 */
class PartsTable extends Table
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

        $this->getTable('parts');
        $this->setDisplayField('partname');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id'
        ]);
        $this->hasMany('Assigned', [
            'foreignKey' => 'part_id'
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'part_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'parts_roles'
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
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->allowEmpty('partname');

        $validator
            ->integer('minutes')
            ->allowEmpty('minutes');

        $validator
            ->requirePresence('min_suffix', 'create')
            ->notEmpty('min_suffix');

        $validator
            ->boolean('assistant')
            ->requirePresence('assistant', 'create')
            ->notEmpty('assistant');

        $validator
            ->integer('sort_order')
            ->allowEmpty('sort_order');

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
        $rules->add($rules->existsIn(['section_id'], 'Sections'));
        return $rules;
    }
}
