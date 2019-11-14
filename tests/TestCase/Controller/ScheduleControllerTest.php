<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ScheduleController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ScheduleController Test Case
 */
class ScheduleControllerTest extends IntegrationTestCase
{

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
        'app.privileges',
        'app.parts',
        'app.sections',
        'app.parts_privileges',
        'app.people_privileges'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
