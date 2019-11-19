<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssignedTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssignedTable Test Case
 */
class AssignedTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssignedTable
     */
    public $Assigned;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assigned',
        'app.parts',
        'app.sections',
        'app.roles',
        'app.parts_roles',
        'app.people',
        'app.assistants',
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
        $config = TableRegistry::exists('Assigned') ? [] : ['className' => 'App\Model\Table\AssignedTable'];
        $this->Assigned = TableRegistry::get('Assigned', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Assigned);

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
