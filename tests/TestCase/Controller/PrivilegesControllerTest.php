<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PrivilegesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PrivilegesController Test Case
 */
class PrivilegesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.privileges',
        'app.parts',
        'app.sections',
        'app.assigned',
        'app.meetings',
        'app.schedules',
        'app.people',
        'app.people_privileges',
        'app.parts_privileges'
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
