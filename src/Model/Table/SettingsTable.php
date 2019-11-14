<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @method \App\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 */
class SettingsTable extends Table
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

        $this->setTable('settings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('congregation')
            ->maxLength('congregation', 45)
            ->allowEmptyString('congregation');

        $validator
            ->scalar('application_name')
            ->maxLength('application_name', 45)
            ->allowEmptyString('application_name');

        $validator
            ->integer('meetings_per_page')
            ->allowEmptyString('meetings_per_page');

        $validator
            ->scalar('author')
            ->maxLength('author', 50)
            ->allowEmptyString('author');

        $validator
            ->scalar('custom_field_1')
            ->maxLength('custom_field_1', 45)
            ->allowEmptyString('custom_field_1');

        $validator
            ->scalar('custom_field_2')
            ->maxLength('custom_field_2', 45)
            ->allowEmptyString('custom_field_2');

        $validator
            ->scalar('custom_field_3')
            ->maxLength('custom_field_3', 45)
            ->allowEmptyString('custom_field_3');

        $validator
            ->scalar('custom_field_4')
            ->maxLength('custom_field_4', 45)
            ->allowEmptyString('custom_field_4');

        return $validator;
    }
}
