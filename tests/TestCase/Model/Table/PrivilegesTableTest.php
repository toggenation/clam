<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrivilegesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrivilegesTable Test Case
 */
class PrivilegesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrivilegesTable
     */
    public $Privileges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.privileges',
        'app.parts',
        'app.sections',
        'app.parts_privileges',
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
        $config = TableRegistry::exists('Privileges') ? [] : ['className' => 'App\Model\Table\PrivilegesTable'];
        $this->Privileges = TableRegistry::get('Privileges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Privileges);

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
