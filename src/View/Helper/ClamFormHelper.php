<?php

namespace App\View\Helper;

class ClamFormHelper extends \Bootstrap\View\Helper\FormHelper
{

    public function postLink($title, $url = null, array $options = [])
    {
        // debug(['title' => $title, 'url' => $url, 'options' => $options]);
        $actions = [
            'view', 'edit', 'delete'
        ];

        $currentClass = '';

        if (isset($url['action']) && in_array($url['action'], $actions)) {
            if (isset($options['class'])) {
                $currentClass = $options['class'];
            }
            if (strpos($currentClass, 'nav-link') === false) {
                $options['class'] = trim($currentClass . ' ' . $url['action'] .  ' btn btn-link');
            }
        }

        return parent::postLink($title, $url, $options);
    }
}
