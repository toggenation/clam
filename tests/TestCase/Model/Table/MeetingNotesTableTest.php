<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MeetingNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MeetingNotesTable Test Case
 */
class MeetingNotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MeetingNotesTable
     */
    public $MeetingNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meeting_notes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MeetingNotes') ? [] : ['className' => 'App\Model\Table\MeetingNotesTable'];
        $this->MeetingNotes = TableRegistry::get('MeetingNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MeetingNotes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
