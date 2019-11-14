<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SchedulesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SchedulesController Test Case
 */
class SchedulesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schedules',
        'app.meetings',
        'app.assigned',
        'app.parts',
        'app.sections',
        'app.privileges',
        'app.parts_privileges',
        'app.people',
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
