<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MeetingsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MeetingsController Test Case
 */
class MeetingsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meetings',
        'app.schedules',
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
