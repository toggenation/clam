<?php

namespace App\View\Helper;

class PaginatorHelper extends \Bootstrap\View\Helper\PaginatorHelper
{

    /**
     * Default configuration for this class.
     *
     * Options: Holds the default options for pagination links.
     *
     * The values that may be specified are:
     *
     * - `url` Url of the action. See Router::url().
     * - `url['sort']` the key that the recordset is sorted.
     * - `url['direction']` Direction of the sorting (default: 'asc').
     * - `url['page']` Page number to use in links.
     * - `model` The name of the model.
     * - `escape` Defines if the title field for the link should be escaped (default: true).
     *
     * Templates: the templates used by this class.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'options' => [],
        'templates' => [
            'nextActive' => '<li class="page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
            'nextDisabled' => '<li class="page-item disabled"><a class="page-link">{{text}}</a></li>',
            'prevActive' => '<li class="page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
            'prevDisabled' => '<li class="page-item disabled"><a class="page-link">{{text}}</a></li>',
            'counterRange' => '{{start}} - {{end}} of {{count}}',
            'counterPages' => '{{page}} of {{pages}}',
            'first' => '<li class="page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
            'last' => '<li class="page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
            'number' => '<li class="page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
            'current' => '<li class="page-item active"><a href="{{url}}" class="page-link">{{text}}</a></li>',
            //'ellipsis' => '<li class="ellipsis disabled"><a>&hellip;</a></li>',
            'ellipsis' => '',
            'sort' => '<a href="{{url}}">{{text}}</a>',
            'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
            'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
            'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
            'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
        ],
        'templateClass' => 'Bootstrap\View\EnhancedStringTemplate',
    ];


        /**
     * Returns a set of numbers for the paged result set using a modulus to decide how
     * many numbers to show on each side of the current page (default: 8).
     *
     * ```
     * $this->Paginator->numbers(['first' => 2, 'last' => 2]);
     * ```
     *
     * Using the first and last options you can create links to the beginning and end of
     * the page set.
     *
     * ### Options
     *
     * - `before` Content to be inserted before the numbers, but after the first links.
     * - `after` Content to be inserted after the numbers, but before the last links.
     * - `model` Model to create numbers for, defaults to PaginatorHelper::defaultModel()
     * - `modulus` How many numbers to include on either side of the current page, defaults
     * to 8. Set to `false` to disable and to show all numbers.
     * - `first` Whether you want first links generated, set to an integer to define the
     * number of 'first' links to generate. If a string is set a link to the first page will
     * be generated with the value as the title.
     * - `last` Whether you want last links generated, set to an integer to define the
     * number of 'last' links to generate. If a string is set a link to the last page will
     * be generated with the value as the title.
     * - `size` Size of the pagination numbers (`'small'`, `'normal'`, `'large'`). Default
     * is `'normal'`.
     * - `templates` An array of templates, or template file name containing the templates
     * you'd like to use when generating the numbers. The helper's original templates will
     * be restored once numbers() is done.
     * - `url` An array of additional URL options to use for link generation.
     *
     * The generated number links will include the 'ellipsis' template when the `first` and
     * `last` options and the number of pages exceed the modulus. For example if you have 25
     * pages, and use the first/last options and a modulus of 8, ellipsis content will be
     * inserted after the first and last link sets.
     *
     * @param array $options Options for the numbers.
     *
     * @return string numbers string.
     * @link http://book.cakephp.org/3.0/en/views/helpers/paginator.html#creating-page-number-links
     */
    public function numbers(array $options = []) {

        $defaults = [
            'before' => null, 'after' => null, 'model' => $this->defaultModel(),
            'modulus' => 8, 'first' => null, 'last' => null, 'url' => [],
            'prev' => null, 'next' => null, 'class' => '', 'size' => false,
            'wrapWithUL' => true
        ];
        $options += $defaults;

        $options = $this->addClass($options, 'pagination');

        switch ($options['size']) {
        case 'small':
            $options = $this->addClass($options, 'pagination-sm');
            break;
        case 'large':
            $options = $this->addClass($options, 'pagination-lg');
            break;
        }
        unset($options['size']);

        if ($options['wrapWithUL']) {
            $options['before'] .= $this->Html->tag('ul', null, ['class' => $options['class']]);
            $options['after'] = '</ul>' . $options['after'];
        }

        unset($options['class']);

        $params = (array)$this->params($options['model']) + ['page' => 1];
        if ($params['pageCount'] <= 1) {
            return false;
        }

        $templater = $this->templater();
        if (isset($options['templates'])) {
            $templater->push();
            $method = is_string($options['templates']) ? 'load' : 'add';
            $templater->{$method}($options['templates']);
        }

        $first = $prev = $next = $last = '';

        /* Previous and Next buttons (addition from standard PaginatorHelper). */

        if ($options['prev']) {
            $title = $options['prev'];
            $opts  = [];
            if (is_array($title)) {
                $title = $title['title'];
                unset ($options['prev']['title']);
                $opts  = $options['prev'];
            }
            $prev = $this->prev($title, $opts);
        }
        unset($options['prev']);

        if ($options['next']) {
            $title = $options['next'];
            $opts  = [];
            if (is_array($title)) {
                $title = $title['title'];
                unset ($options['next']['title']);
                $opts  = $options['next'];
            }
            $next = $this->next($title, $opts);
        }
        unset($options['next']);

        /* Custom First and Last. */

        list($start, $end) = $this->_getNumbersStartAndEnd($params, $options);

        $ellipsis = $templater->format('ellipsis', []);
        $first = $this->_firstNumber($ellipsis, $params, $start, $options);
        $last = $this->_lastNumber($ellipsis, $params, $end, $options);

        $before = (is_int($options['first']) && $options['first'] > 1) ? $prev.$first : $first.$prev;
        $after  = (is_int($options['last']) && $options['last'] > 1) ? $last.$next : $next.$last;

        $options['before'] = $options['before'].$before;;
        $options['after']  = $after.$options['after'];

        // New options used to allow the _getNumbersStartAndEnd method to work correctly without having
        // the actual last and first number outputed by the _modulusNumbers.
        $options['first_'] = $options['first'];
        $options['last_'] = $options['last'];
        $options['first'] = null;
        $options['last'] = null;

        if ($options['modulus'] !== false && $params['pageCount'] > $options['modulus']) {
            $out = $this->_modulusNumbers($templater, $params, $options);
        } else {
            $out = $this->_numbers($templater, $params, $options);
        }

        if (isset($options['templates'])) {
            $templater->pop();
        }

        return $out;
    }

}
