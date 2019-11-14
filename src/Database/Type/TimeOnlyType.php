<?php
namespace App\Database\Type;

use App\I18n\FrozenTimeOnly;
use Cake\Database\Driver;
use Cake\Database\Type\TimeType;
use Cake\Log\LogTrait;
/**
 * TimeOnlyType
 * This class converts a string time "7:31 pm" to a  a time to the database in th
 */
class TimeOnlyType extends TimeType
{
    //protected $_format = 'h:i A';

    use LogTrait;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->_setClassName(FrozenTimeOnly::class, \DateTimeImmutable::class);
    }

    public function toDatabase($value, Driver $driver)
    {

        $pattern = '/(am|pm)$/i';

        if (preg_match($pattern, $value)) {
            $date = new \DateTime();
            $new_date = $date->createFromFormat('H:i A', $value);
            // converts to int for is_int call below
            $value = $new_date->getTimestamp();

        }

        if ($value === null || is_string($value)) {
            return $value;
        }

        if (is_int($value)) {
            $class = $this->_className;
            $value = new $class('@' . $value);
        }

        return $value->format($this->_format);
    }

}
