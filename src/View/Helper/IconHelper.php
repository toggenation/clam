<?php

namespace App\View\Helper;

use Cake\View\View;
use Cake\View\Helper\HtmlHelper;

class IconHelper extends HtmlHelper
{

    // initialize() hook is available since 3.2. For prior versions you can
    // override the constructor if required.
    public function initialize(array $config)
    {

    }

    public function gIcon($icon)
    {
        $format = 'glyphicon glyphicon-%s';

        return $this->tag('span', '', [ 'class' => sprintf($format, $icon)]);
    }

    /**
     * faIcon
     * @param string $icon Classes to pass to tag function
     * @param array $options an array of HTML attributes or configuration options for tag()
     * @return string
     */
    public function faIcon($icon, $options = [])
    {
        $optionsToTag = [ 'class' => $icon ] + $options;

        return $this->tag('i', '', $optionsToTag );
    }

}
