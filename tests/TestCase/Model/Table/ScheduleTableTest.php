<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScheduleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScheduleTable Test Case
 */
class ScheduleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ScheduleTable
     */
    public $Schedule;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schedule',
        'app.meetings',
        'app.schedules',
        'app.assigned',
        'app.people',
        'app.roles',
        'app.parts',
        'app.sections',
        'app.parts_roles',
        'app.people_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Schedule') ? [] : ['className' => 'App\Model\Table\ScheduleTable'];
        $this->Schedule = TableRegistry::get('Schedule', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Schedule);

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
