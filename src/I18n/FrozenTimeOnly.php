<?php

namespace App\I18n;

use Cake\I18n\FrozenTime;

class FrozenTimeOnly extends FrozenTime
{
    /**
     * this is the format for date (none) and time (3:30 pm)
     */
    protected static $_toStringFormat = [
        \IntlDateFormatter::NONE,
        \IntlDateFormatter::SHORT
    ];
}