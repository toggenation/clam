<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeopleRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeopleRolesTable Test Case
 */
class PeopleRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PeopleRolesTable
     */
    public $PeopleRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.people_roles',
        'app.people',
        'app.assigned',
        'app.meetings',
        'app.schedules',
        'app.roles',
        'app.parts',
        'app.sections',
        'app.parts_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PeopleRoles') ? [] : ['className' => 'App\Model\Table\PeopleRolesTable'];
        $this->PeopleRoles = TableRegistry::get('PeopleRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PeopleRoles);

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
