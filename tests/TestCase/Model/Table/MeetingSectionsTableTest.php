<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MeetingSectionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MeetingSectionsTable Test Case
 */
class MeetingSectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MeetingSectionsTable
     */
    public $MeetingSections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meeting_sections',
        'app.parts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MeetingSections') ? [] : ['className' => 'App\Model\Table\MeetingSectionsTable'];
        $this->MeetingSections = TableRegistry::get('MeetingSections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MeetingSections);

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
