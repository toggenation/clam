<?php

namespace App\View\Helper;

use Bootstrap\View\Helper\HtmlHelper;

class ClamHtmlHelper extends  HtmlHelper
{


    public function link($title, $url = null, array $options = [])
    {

        $actions = [
            'view', 'edit', 'delete'
        ];

        $currentClass = '';

        if (isset($url['action']) && in_array($url['action'], $actions)) {
            if (isset($options['class'])) {
                $currentClass = $options['class'];
            }

            if (strpos($options['class'], 'nav-link') === false) {
                $options['class'] = trim($currentClass . ' ' . $url['action'] .  ' btn btn-link');
            }
        }

        return parent::link($title, $url, $options);
    }
    function genderIcon($brother = true)
    {
        $iconName = $brother ? 'fa-male' : 'fa-female';
        $classes = sprintf('fas %s', $iconName);

        $icon = $this->tag('i', '', ['class' => $classes]);
        return $icon;
    }
}
