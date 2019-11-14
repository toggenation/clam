<?php
namespace App\Model\Table;

use App\Model\Entity\Section;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sections Model
 *
 * @property \Cake\ORM\Association\HasMany $Parts
 */
class SectionsTable extends Table
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

        $this->setTable('sections');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Parts', [
            'foreignKey' => 'section_id'
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
            ->allowEmpty('name');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

        $validator
            ->boolean('heading')
            ->requirePresence('heading', 'create')
            ->notEmpty('heading');

        return $validator;
    }
}
