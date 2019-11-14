<?php
namespace App\Model\Entity;

use Cake\I18n\Time;
use Cake\Log\LogTrait;
use Cake\ORM\Entity;

/**
 * Schedule Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property string $month
 * @property string $comment
 * @property \App\Model\Entity\Meeting[] $meetings
 */
class Schedule extends Entity
{
    use LogTrait;

    protected $_virtual = ['month_year'];

    protected function _getYear()
    {
        $year = null;
        if (isset($this->_properties['start_date'])) {
            $date = new Time($this->_properties['start_date']);
            $year = $date->format('y');
        }

        return $year;
    }

    protected function _getMonthYear()
    {
        $monthYear = null;
        if (isset($this->_properties['start_date'])) {
            $date = new Time($this->_properties['start_date']);
            $monthYear = $date->i18nFormat('MMMM') . ' ' . $date->format('Y');
        }

        return $monthYear;
    }

    protected function _getFullYear()
    {
        $fullYear = null;

        if ( isset($this->_properties['start_date'])) {
            $date = new Time($this->_properties['start_date']);
            $fullYear = $date->format('Y');
        }

        return $fullYear;
    }

    protected function _getMonthNumber()
    {
        $monthNumber = null;

        if (isset($this->_properties['start_date'])) {
            $date = new Time($this->_properties['start_date']);
            $monthNumber = $date->format('m');
        }

        return $monthNumber;
    }

    protected function _getShortMonth()
    {
        $shortMonth = null;

        if (isset($this->_properties['start_date'])) {
            $date = new Time($this->_properties['start_date']);
            $shortMonth = $date->format('M');
        }

        return $shortMonth;
    }

    protected function _getRange()
    {
        $dateRange = null;

        if (isset($this->_properties['start_date']) && isset($this->_properties['end_date']) ){
            $start_date = new Time($this->_properties['start_date']);
            $end_date = new Time($this->_properties['end_date']);
            $dateRange = $start_date->format('M') . ' - ' . $start_date->format('d/m/Y') . ' - ' .
            $end_date->format('d/m/Y');
        }

        return $dateRange;
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
