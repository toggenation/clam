<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartsRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartsRolesTable Test Case
 */
class PartsRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PartsRolesTable
     */
    public $PartsRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parts_roles',
        'app.parts',
        'app.sections',
        'app.roles',
        'app.people',
        'app.assigned',
        'app.meetings',
        'app.schedules',
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
        $config = TableRegistry::exists('PartsRoles') ? [] : ['className' => 'App\Model\Table\PartsRolesTable'];
        $this->PartsRoles = TableRegistry::get('PartsRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PartsRoles);

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
