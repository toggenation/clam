<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartsPrivilegesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartsPrivilegesTable Test Case
 */
class PartsPrivilegesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PartsPrivilegesTable
     */
    public $PartsPrivileges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parts_privileges',
        'app.parts',
        'app.sections',
        'app.privileges',
        'app.people',
        'app.assigned',
        'app.meetings',
        'app.schedules',
        'app.people_privileges'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PartsPrivileges') ? [] : ['className' => 'App\Model\Table\PartsPrivilegesTable'];
        $this->PartsPrivileges = TableRegistry::get('PartsPrivileges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PartsPrivileges);

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
