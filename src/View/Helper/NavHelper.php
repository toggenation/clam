<?php

namespace App\View\Helper;

use Bootstrap\View\Helper\NavbarHelper;
use Cake\View\Helper\HtmlHelper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NavHelper extends NavbarHelper {
     /**
     * Default configuration for the helper.
     *
     * - `autoActiveLink` Set to `true` to automatically add `active` class
     * when given URL for a link matches the current URL. Default is `true`.
     * - `autoButtonLink` Set to  true` to automatically create buttons instead
     * of links when outside a menu. Default is `true`.
     *
     * @var array
     */
    public $_defaultConfig = [
        'templates' => [
            'navbarStart' => '<nav class="navbar{{attrs.class}}"{{attrs}}>{{containerStart}}{{header}}{{responsiveStart}}',
            'navbarEnd' => '{{responsiveEnd}}{{containerEnd}}</nav>',
            'containerStart' => '<div class="container{{attrs.class}}"{{attrs}}>',
            'containerEnd' => '</div>',
            'responsiveStart' => '<div class="collapse navbar-collapse{{attrs.class}}" id="{{id}}"{{attrs}}>',
            'responsiveEnd' => '</div>',
            'header' => '{{brand}}{{toggleButton}}',
            'toggleButton' =>
'<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#{{id}}" aria-controls="{{id}}" aria-label="{{label}}" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
</button>',
            'brand' => '<a class="navbar-brand{{attrs.class}}" href="{{url}}"{{attrs}}>{{content}}</a>',
            'brandImage' => '<img alt="{{brandname}}" src="{{src}}"{{attrs}} />',
            'dropdownMenuStart' => '<div class="dropdown-menu{{attrs.class}}"{{attrs}}>',
            'dropdownMenuEnd' => '</div>',
            'dropdownLink' =>
'<a href="{{url}}" class="nav-link dropdown-toggle{{attrs.class}}" data-toggle="dropdown" role="button"
aria-haspopup="true" aria-expanded="false">{{content}}</a>',
            'innerMenuStart' => '<li class="nav-item dropdown{{attrs.class}}"{{attrs}}>{{dropdownLink}}{{dropdownMenuStart}}',
            'innerMenuEnd' => '{{dropdownMenuEnd}}</li>',
            'innerMenuItem' => '{{link}}',
            'innerMenuItemLink' => '<a href="{{url}}" class="dropdown-item{{attrs.class}}"{{attrs}}>{{content}}</a>',
            'innerMenuItemActive' => '{{link}}',
            'innerMenuItemLinkActive' => '<a href="{{url}}" class="dropdown-item active{{attrs.class}}"{{attrs}}>{{content}}</a>',
            'innerMenuItemDivider' => '<div role="separator" class="dropdown-divider{{attrs.class}}"{{attrs}}></div>',
            'innerMenuItemHeader' => '<h6 class="dropdown-header{{attrs.class}}"{{attrs}}>{{content}}</h6>',
            'outerMenuStart' => '<ul class="navbar-nav {{attrs.class}}"{{attrs}}>',
            'outerMenuEnd' => '</ul>',
            'outerMenuItem' => '<li class="nav-item{{attrs.class}}"{{attrs}}>{{link}}</li>',
            'outerMenuItemLink' => '<a href="{{url}}" class="nav-link{{attrs.class}}"{{attrs}}>{{content}}</a>',
            'outerMenuItemActive' => '<li class="nav-item active{{attrs.class}}"{{attrs}}>{{link}}</li>',
            'outerMenuItemLinkActive' => '<a href="{{url}}" class="nav-link{{attrs.class}}"{{attrs}}>{{content}}</a>',
            'navbarText' => '<span class="navbar-text{{attrs.class}}"{{attrs}}>{{content}}</span>',
        ],
        'templateClass' => 'Bootstrap\View\EnhancedStringTemplate',
        'autoActiveLink' => true
    ];

}
