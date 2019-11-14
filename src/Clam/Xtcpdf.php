<?php

namespace App\Clam;

use Cake\Core\Configure;
use Cake\I18n\Date;
use Cake\Log\LogTrait;

/**
 * @class Xtcpdf
 *
 */
class Xtcpdf extends \TCPDF
{

    use LogTrait;

    private $user = '';
    public $page_break = false;

    /* the width of the apply heading color width */
    protected $_colorHeadingWidth = 90;

    /**
     * array containing column widths for assignments
     * @var array
     */
    protected $_cols = [
        10, // time
        93, // partname
        41, // assistant
        36, // assigned to
    ];

    public $prefixedAssistant = false;

    /**
     * total width of pdf write area is the sum of _cols
     * set in __construct
     * @var integer
     */

    protected $_total_width = 0;

    /**
     * Contains Chairman Full Name
     * @var string
     */
    public $chairman = '';
    public $aux_counselor = "";

    protected $_meeting_title = '';
    /**
     * School Title Font Size (Assistant / Student)
     * @var int
     */
    protected $_fontSizeSchoolTitle = 9;
    protected $_fontSizeClamTitle = 17;
    protected $_fontSizeTreasuresTitle = 10;
    protected $_fontColorTitle = [255, 255, 255]; // white

    private $_titleFont = 'helvetica';
    private $_bodyFont = 'helvetica';
    private $_meetingNoteTitleFont = 'helvetica';
    private $_assistantStudentTitleFont = 'helvetica';

    protected $_lpad = 1.5;

    public $last_record = false;

    protected $_clamX = 0;
    protected $_clamY = 0;
    protected $_border_color = [56, 94, 93];
    protected $_line_height = 4.5; // assignment line height

    /**
     * @var int
     *
     */
    protected $_start_page = 0;

    /**
     *
     * @var int
     */
    protected $_end_page = 0;

    public $_clamTitle = [];

    /**
     * Defaults used when writing assignments
     * @var array
     */

    protected $_assignment_defaults = [
        'time' => '',
        'partname' => '',
        'assistant' => '',
        'assigned' => '',
        'has_auxiliary' => false,
        'school' => false,
        'school_title' => false,
        'reader_tag' => false,
        'assistant_tag' => false,
        'top_border' => false,
    ];

    // ids that we need to put reader or prayer and brackets
    //  these are a mapping of the array key a particular record exists at
    //  to the correct function to use to print the title
    // really dumb that I have this embedded here

    public $bible_reading = 18;

    protected $_titleFunctionNames = [
        'clamTitle',
        'treasuresTitle',
        'applyTitle',
        'livingTitle',
        'schoolTitle',
    ];

    /**
     *
     * @var string
     */
    protected $_clam_title_template = '{{cong}} - {{title}} - {{month}} {{year}}';
    //SetDrawColorArray
    /**
     * _tokens used to replace the month year values in the clam_title_template
     *
     * @var array
     */
    protected $_tokens = [
        '{{cong}}',
        '{{title}}',
        '{{month}}',
        '{{year}}'
    ];


    /**
     * set defaults
     */
    public function __construct()
    {
        parent::__construct();

        $this->_total_width = array_sum($this->_cols);

        $this->SetDrawColorArray($this->_border_color);
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }

    /**
     * getMeetingTitles
     * @param string $stored_id Stored ID
     * @return string
     */
    public function getMeetingTitles($stored_id = null)
    {
        if ($stored_id !== null && in_array($stored_id, array_keys($this->_titleFunctionNames))) {
            return $this->_titleFunctionNames[$stored_id];
        } else {
            return $this->_titleFunctionNames;
        }
    }

    /**
     * Draws CLAM Title
     * @param array $replace replace the values in the clam titles
     */
    public function clamTitle($replace = [])
    {
        $this->_clamTitle = $replace; // store for later
        $txt = str_replace($this->_tokens, $replace, $this->_clam_title_template);

        $this->SetTextColorArray($this->_fontColorTitle);

        $this->SetFont($this->_titleFont, '', $this->_fontSizeClamTitle);

        $this->setCellPaddings(0, 0, 0, 0);
        // set cell margins
        $this->setCellMargins(0, 0, 0, 0);
        // set color for background
        $this->SetFillColor(37, 77, 73); // clam heading
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        // Multicell test
        $this->MultiCell($this->_total_width, 0, $txt, 'LTRB', 'C', 1, 1, '', '', true);
        $this->ln(0); // mm
    }

    public function schoolTitle($values = [])
    {

        $this->_startTrans();
        //$this->ln(6); // mm

        $this->SetTextColorArray([0, 0, 0]); //black

        $this->SetFillColor(255, 255, 255); //white

        $this->setCellPaddings(0, 0, 0, 0);

        $this->SetFont($this->_titleFont, 'B', 9);

        $this->MultiCell($this->_colorHeadingWidth, 0, '', 'LTB', 'L', 1, $ln = 0, '', '', true);

        $col2 = ($this->_cols[0] + $this->_cols[1]) - $this->_colorHeadingWidth;

        $this->setCellPaddings(0, 0, 0, 0);

        $this->SetFillColor(209, 227, 237); // light blue / gray

        $this->MultiCell(
            $col2,
            0,
            '',
            'BT', 'L', 1, $line = 0, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = false
        );

        $this->MultiCell(
            $this->_cols[2],
            0,
            $values['auxTitle'],
            'BT', 'L', 1, $line = 0, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = true
        );

        $this->MultiCell(
            $this->_cols[3],
            0,
            $values['mainTitle'],
            'BTR', 'L', 1, 1, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = true
        );

        $this->_endTrans(__FUNCTION__, $values);

    }

    /**
     * Draws TUESDAY JUNE 21 meeting heading
     * @param string $txt
     */
    public function meetingTitle($txt, $chairman = null, $aux_counselor = null)
    {

        $this->_startTrans();
        $this->ln(5); // mm
        $this->_meeting_title = $txt;
        //$this->_chairman = $chairman;
        //$this->_aux_counselor = $aux_counselor;

        $this->SetTextColorArray($this->_fontColorTitle);
        $this->SetFillColor(56, 94, 93); // meeting title
        $this->SetFont($this->_titleFont, 'B', 12);
        $this->setCellPaddings($this->_lpad, 0, 0, 0);
        //$args = [$this->_total_width, 0, $txt, 'LTR', 'L', 1, 1, '', '', true];
        //$this->smartPageBreak($args);
        $this->MultiCell($this->_total_width, 0, $txt, 'LTR', 'L', 1, 1, '', '', true);

        //white

        if (!($chairman === null && $aux_counselor === null)) {

            $this->SetFillColor(255, 255, 255);
            $this->SetTextColorArray([0, 0, 0]); //black
            $this->SetFont('helvetica', '', 10);

            $this->setCellPaddings(0, 0, 1, 0);

            $this->SetFont('helvetica', 'B', 10);

            $this->MultiCell($this->_cols[0] + $this->_cols[1] + $this->_cols[2], 0, "Chairman: ", 'L', 'R', 1, $line = 0, '', '', true);

            $this->SetFont('helvetica', '', 10);
            $this->MultiCell($this->_cols[3], 0, $chairman, 'R', 'L', 1, $line = 1, '', '', true);
            $this->SetFont('helvetica', 'B', 10);

            $this->MultiCell($this->_cols[0] + $this->_cols[1] + $this->_cols[2], 0, "Auxiliary Classroom Counselor: ", 'LB', 'R', 1, $line = 0, '', '', true);
            $this->SetFont('helvetica', '', 10);
            $this->MultiCell($this->_cols[3], 0, $aux_counselor, 'RB', 'L', 1, $line = 1, '', '', true);
        }

        $this->_endTrans(__FUNCTION__, $txt);

    }

    /**
     * Treasures from God's Word Title
     * @param string $txt
     */
    public function treasuresTitle($txt)
    {
        $this->_startTrans();

        $this->setCellPaddings($this->_lpad, 0, 0, 0);
        $this->SetTextColorArray($this->_fontColorTitle);
        $this->SetFillColor(96, 105, 112); // treasures
        $this->SetFont($this->_titleFont, '', $this->_fontSizeTreasuresTitle);

        $this->MultiCell($this->_colorHeadingWidth, 0, $txt, 'LR', 'L', 1, 0, '', '', true);

        $this->SetTextColor(0, 0, 0); //black
        $this->SetFillColor(255, 255, 255); // white

        $this->setCellPaddings(0, 0, 0, 0);

        $this->MultiCell(
            $this->_total_width - $this->_colorHeadingWidth,
            0,
            '',
            'BTR', 'L', 1, $line = 1, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = false
        );

        $this->_endTrans(__FUNCTION__, $txt);
    }

    /**
     * Apply Yourself to the Field Ministry Title
     * @param string $txt
     */
    public function applyTitle($txt)
    {

        $this->_startTrans();

        $this->setCellPaddings($this->_lpad, 0, 0, 0);
        $this->SetTextColorArray($this->_fontColorTitle);
        $this->SetFillColor(193, 134, 38); // apply
        $this->SetFont($this->_titleFont, '', 10);
        //$args = [$this->_total_width, 0, $txt, 'LR', 'L', 1, 1, '', '', true];
        //$this->smartPageBreak($args);
        // w h txt border = Left right t, align, fill
        $this->MultiCell(
            $this->_colorHeadingWidth, // width
            0, // h
            $txt, // text
             'TBL', // border
             'L', // align
            1, // fill
            0, // ln
             '', // x
             '', //y
            true//reseth
        );
        $this->SetFont($this->_titleFont, '', 9);
        // $this->SetFillColor(255, 255, 255); // apply
        $this->SetTextColor(0, 0, 0); //black
        $this->SetFillColor(237, 245, 247); // light blue gray
        $col2 = ($this->_cols[0] + $this->_cols[1]) - $this->_colorHeadingWidth;

        $this->setCellPaddings(0, 0, 0, 0);

        $this->MultiCell(
            $col2,
            0,
            '',
            'BT', 'L', 1, $line = 0, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = false
        );

        $this->MultiCell(
            $this->_cols[2],
            0,
            'Student/Assistant',
            'BT', 'L', 1, $line = 0, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = false
        );

        $this->MultiCell(
            $this->_cols[3],
            0,
            'Student/Assistant',
            'BTR', 'L', 1, 1, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = false
        );
        $this->_endTrans(__FUNCTION__, $txt);
    }

    /**
     * Living as Christians Title
     * @param string $txt
     */
    public function livingTitle($txt)
    {

        $this->_startTrans();

        $this->setCellPaddings($this->_lpad, 0, 0, 0);
        $this->SetTextColorArray($this->_fontColorTitle);
        $this->SetFont($this->_titleFont, '', 10);
        $this->SetFillColor(150, 21, 38); // living
        //$args = [$this->_total_width, 5, $txt, 'LR', 'L', 1, 1, '', '', true];
        //$this->smartPageBreak($args);
        $this->MultiCell($this->_colorHeadingWidth, 5, $txt, 'LBT', 'L', 1, 0, '', '', true);

        $this->SetTextColor(0, 0, 0); //black
        $this->SetFillColor(255, 255, 255); // white

        $this->setCellPaddings(0, 0, 0, 0);

        $this->MultiCell(
            $this->_total_width - $this->_colorHeadingWidth,
            0,
            '',
            'BTR', 'L', 1, $line = 1, '', '', false,
            $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'M', $fitcell = false
        );

        $this->_endTrans(__FUNCTION__, $txt);

    }

    /**
     * Sets default font, cell padding, text colour and margins
     * common settings
     */
    protected function _config_settings()
    {

        // default font size is 10
        $this->SetFont($this->_bodyFont, '', 10);

        // padding
        $this->setCellPaddings(0, 0, 0, 0);

        // text color
        $this->SetTextColorArray([0, 0, 0]);

        // set cell margins
        $this->setCellMargins(0, 0, 0, 0);

    }

    public function meetingNote($values = [])
    {

        $this->_startTrans();

        $this->_config_settings();

        list($this->_clamX, $this->_clamY) = [$this->GetX(), $this->GetY()];
        $borders = 0;

        $this->SetFont($this->_meetingNoteTitleFont, 'B', 12);

        $cell_count = $this->MultiCell($this->_total_width, $this->_line_height, $values['heading'], $borders, 'C', 0, 1, '', '', true); //time

        $this->SetFont($this->_bodyFont, '', 10);

        $cell_count += $this->MultiCell($this->_total_width, $this->_line_height, $values['note'], $borders, 'C', 0, 1, '', '', true); //time

        $cellH = $cell_count;

        $end_y = $this->GetY() - $this->_clamY;
        // return to X,Y from at start
        $this->SetXY($this->_clamX, $this->_clamY);

        // write lower bottom and right border
        // write top if we did a page break
        $border = 'LBR';

        // this writes borders and moves to next line
        $this->MultiCell($this->_total_width, $end_y, '', $border, 'L', 0, $ln = 1, '', '', true);

        // check for page jump
        $this->_endTrans(__FUNCTION__, $values);
    }

    private function formatAssignments($values, $field, $other)
    {

        $newval = '';

        if (array_key_exists($other, $values) && array_key_exists($field, $values)) {

            if (!empty($values[$other])) {
                $newval = $values[$field] . " / " . $values[$other];
                // $values[$field] . "\u{00B9}" .  "/" .  $values[$other] . json_decode('"\u00B2"');
            } else {
                $newval = $values[$field];
            }

        }
        return $newval;

    }
    /**
     *
     * @param array $values
     */

    /*public function assignment($values = [])
    {
    if($values['has_auxliary']){
    $this->schoolAssignment( $values);
    } else {
    $this->schoolAssignment( $values);
    }
    }
     */

    public function assignment($values = [])
    {

        // start a transaction
        $this->_startTrans();

        // defaults
        $values += $this->_assignment_defaults;

        // store X,Y location before cell writes
        // so we can return to this point when we
        // write the borders
        list($this->_clamX, $this->_clamY) = [$this->GetX(), $this->GetY()];

        $this->_config_settings();

        // don't draw borders when writing the text
        $borders = 0;

        // time
        $cell_count[] = $this->MultiCell($this->_cols[0], $this->_line_height, $values['time'], $borders, 'C', 0, 0, '', '', true); //time

        // partname
        $cell_count[] = $this->MultiCell($this->_cols[1], $this->_line_height, $values['partname'], $borders, 'L', 0, 0, '', '', true);

        $this->_clamFontSet($values, 'assistant');

        // write reader / assistant / prayer value

        if ($values['has_auxliary']) {
            $field1 = 'aux_assigned';
            $other1 = 'aux_assistant';
            $field2 = 'assigned';
            $other2 = 'assistant';
        } else {
            $field1 = 'assistant';
            $field2 = 'assigned';
            $other1 = 'aux_assistant';
            $other2 = 'aux_assigned';
        }

        $cell_count[] = $this->MultiCell(
            $this->_cols[2], $this->_line_height,
            $this->formatAssignments(
                $values,
                $field1,
                $other1
            ),
            $borders, 'L', false, 0, '', '', true);

        $this->_clamFontSet($values, 'assigned');

        // assigned
        $cell_count[] = $this->MultiCell(
            $this->_cols[3],
            $this->_line_height,
            $this->formatAssignments(
                $values,
                $field2,
                $other2
            ),
            $borders, 'L', false, 0, '', '', true);

        //\Cake\Log\LogTrait::log($cell_count);

        $cellH = max($cell_count);

        // return to X,Y from at start
        $this->SetXY($this->_clamX, $this->_clamY);

        // write lower bottom and right border
        // write top if we did a page break
        $border = $values['top_border'] ? 'LTRB' : 'LBR';

        // this writes borders and moves to next line
        $this->MultiCell($this->_total_width, $cellH * $this->_line_height, '', $border, 'L', 0, $ln = 1, '', '', true);

        // check for page jump
        $this->_endTrans(__FUNCTION__, $values);

    }

    protected function _clamFontSet($values, $stage = null)
    {

        // assistant student

        if ($values['school_title'] && $stage == 'assistant') {
            $this->SetFont($this->_assistantStudentTitleFont, 'BI', $this->_fontSizeSchoolTitle);
        }

        if ($values['school_title'] && $stage == 'assigned') {
            $this->SetFont($this->_assistantStudentTitleFont, 'BI', $this->_fontSizeSchoolTitle);
        }

        // if it has a ( then it is a Reader / Prayer so Italisize it
        if ($this->_prefixedAssistant && $stage == 'assistant') {
            $this->SetFont($this->_bodyFont, '', 9);
        }

        if (!$values['school_title'] && $stage == 'assigned') {
            $this->SetFont($this->_bodyFont, '', 10);
        }

    }
    /**
     * Starts a transaction
     * sets the _start_page property
     *
     */
    protected function _startTrans()
    {
        $this->startTransaction();
        $this->_start_page = $this->getPage(); // starting page

    }

    /**
     * Calculates current page number compares to start
     * @param string $method_name
     * @param mixed array|string $value
     */

    protected function _endTrans($method_name, $value)
    {

        //Log::write('debug', $method_name);

        $this->_end_page = $this->getPage();

        // $this->_endTrans(__METHOD__, $values);

        if (($this->_start_page !== $this->_end_page)) {
            /*
             *  if we have added a page half way through writing a line
             *  we don't want it to break across pages so
             *  roll it back and then add a new page and
             *  rewrite it
             */

            $this->rollbackTransaction(true);

            $this->AddPage();

            $this->clamTitle($this->_clamTitle); // add title again

            //if (! $this->last_record){
            $this->meetingTitle($this->_meeting_title . ' continued...');
            $border = true ? 'LTRB' : 'LBR';

            // this writes borders and moves to next line
            $this->MultiCell($this->_total_width, $this->_line_height, '', $border, 'L', 0, $ln = 1, '', '', true);

            //}
            $this->page_break = true;

            // call it again and tell the last border
            // writing writeCell to add a top border this
            // time

            if (is_array($value)) {
                $value['top_border'] = true;
            }

            $this->$method_name($value, $this->_chairman, $this->_aux_counselor);

        }

    }

    public function Footer()
    {

        // Position at 15 mm from bottom
        $this->SetY(-10);

        // cakephp date object
        $cakephp_date = new Date();

        // Set font
        $this->SetFont($this->_bodyFont, 'I', 9);
        // Page number
        //$this->MultiCell($w, $h, $txt, $border, $align, $fill, $ln, $x, $y, $reseth, $stretch, $ishtml, $autopadding)

        // attribution
        $this->MultiCell(60, // $w
            0, // $h
             'Created ' . $cakephp_date->i18nFormat('dd MMM yyyy') . ' by ' . Configure::read('CLAM.app_name'), // $txt
            0, // $border
            $align = 'L', // align
            $fill = 0, // no fill
            0, // ln
            15, // x
             '', //y
            true//reseth, ishtml, autopadding;
        );
        // page number centred
        $this->MultiCell(25, // $w
            0, // $h
            $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), // $txt
            0, // $border
            $align = 'C', // align
            $fill = 0, // no fill
            0, // ln
            100, // x
             '', //y
            true//reseth, ishtml, autopadding;
        );
        // school info
        /*$this->MultiCell(   40, // $w
    0, // $h
    '* Auxiliary School',
    0, // $border
    $align = 'R', // align
    $fill = 0, // no fill
    0, // ln
    155,  // x
    '', //y
    true //reseth, ishtml, autopadding;
    );
     */

    }

    /** returns
     *
     * @param int $assistant_id
     * @return array
     */
    public function assistantFormat($assistant, $assistantPrefix)
    {

        return $assistantPrefix . " " . trim($assistant);
    }

    /**
     *
     * @param int $key
     * @param int $stored_id
     * @param array $complete
     * @return bool
     */
    public function isAfterApplyHeading($stored_id, $complete)
    {
        //return ( (int) $stored_id === 2 && !$complete[$stored_id] ) ? true : false;
        return false;
    }

}
