<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssistantTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssistantTable Test Case
 */
class AssistantTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssistantTable
     */
    public $Assistant;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Assistant') ? [] : ['className' => AssistantTable::class];
        $this->Assistant = TableRegistry::get('Assistant', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Assistant);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
