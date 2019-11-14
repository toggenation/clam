<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonTypeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonTypeTable Test Case
 */
class PersonTypeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonTypeTable
     */
    public $PersonType;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.person_type'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PersonType') ? [] : ['className' => 'App\Model\Table\PersonTypeTable'];
        $this->PersonType = TableRegistry::get('PersonType', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PersonType);

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
