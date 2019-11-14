<?php

namespace App\Model\Table;

use App\Model\Entity\Schedule;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;
use Cake\Log\LogTrait;

//use Cake\Database\Type;

/**
 * Schedules Model
 *
 * @property \Cake\ORM\Association\HasMany $Meetings
 */
class SchedulesTable extends Table {

    use LogTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->getTable('schedules');
        $this->setDisplayField('month');
        $this->setPrimaryKey('id');

        $this->hasMany('Meetings', [
            'dependent' => true,
            'foreignKey' => 'schedule_id',
            'cascadeCallbacks' => true,
        ]);
    }

    // In a table or behavior class
    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data, \ArrayObject $options) {


        // Configure a custom datetime format parser format.
        //Type::build('date')->useLocaleParser()->setLocaleFormat('dd/MM/yyyy');

        if (isset($data['end_date'])) {
            if (!is_array($data['end_date']) && strpos($data['end_date'], '/') !== false) {
                $date = Date::parseDate($data['end_date'], 'dd/MM/yyyy');
                $data['end_date'] = $date;
            }
        }
        if (isset($data['start_date'])) {
            if (!is_array($data['start_date']) && strpos($data['start_date'], '/') !== false) {
                $date = Date::parseDate($data['start_date'], 'dd/MM/yyyy');
                $data['start_date'] = $date;
                $data['month'] = $date->format('F');
            }
        }
    }

    public function convertArrayToDate($date_array = []) {

        return Date::createFromDate(
            $date_array['year'],
            $date_array['month'],
            $date_array['day']
        );
    }

    public function isDateInstance($arrayOrObject) {
        return $arrayOrObject instanceof \Cake\I18n\Date;
    }

    public function checkOverlap($context, $data) {

        #(StartA <= EndB) and (EndA >= StartB)
        #(ScopeStartDate <= EndDate AND ScopeEndDate >= StartDate)

        $start_date = $data['data']['start_date'];
        $end_date = $data['data']['end_date'];


        if (! $this->isDateInstance($start_date)) {
           //$this->log ($start_date);
            $start_date = $this->convertArrayToDate($start_date);
           // $this->log($start_date);
        }
        if (! $this->isDateInstance($end_date)) {
            $end_date = $this->convertArrayToDate($end_date);
        }

        $start_date = $start_date->i18nFormat('yyyy-MM-dd');
        $end_date = $end_date->i18nFormat('yyyy-MM-dd');


        //(StartA <= EndB) and (EndA >= StartB)
        $overlap = $this->find()->where([
            "'" . $start_date . "' <= end_date",
            "'" . $end_date . "' >= start_date"
        ]);

        $overlap_count = $overlap->count();

        return $overlap_count === 0;
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

        $validator
                ->date('start_date')
                ->requirePresence('start_date', 'create')
                ->notEmpty('start_date');

        $validator->add('start_date', 'custom', [
            'rule' => [$this, 'checkOverlap'],
            'message' => 'Schedule range cannot overlap'
        ]);

        $validator->add('end_date', 'custom', [
            'rule' => [$this, 'checkOverlap'],
            'message' => 'Schedule range cannot overlap'
        ]);

        $validator
                ->date('end_date')
                ->requirePresence('end_date', 'create')
                ->notEmpty('end_date');

        $validator
                ->requirePresence('month', 'create')
                ->notEmpty('month');

        $validator
                ->requirePresence('comment', 'create')
                ->allowEmpty('comment');

        return $validator;
    }

}
