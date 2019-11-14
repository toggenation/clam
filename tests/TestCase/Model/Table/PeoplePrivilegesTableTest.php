<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeoplePrivilegesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeoplePrivilegesTable Test Case
 */
class PeoplePrivilegesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PeoplePrivilegesTable
     */
    public $PeoplePrivileges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.people_privileges',
        'app.people',
        'app.assigned',
        'app.meetings',
        'app.schedules',
        'app.privileges',
        'app.parts',
        'app.sections',
        'app.parts_privileges'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PeoplePrivileges') ? [] : ['className' => 'App\Model\Table\PeoplePrivilegesTable'];
        $this->PeoplePrivileges = TableRegistry::get('PeoplePrivileges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PeoplePrivileges);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
