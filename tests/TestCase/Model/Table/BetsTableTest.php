<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BetsTable Test Case
 */
class BetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BetsTable
     */
    protected $Bets;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Bets',
        'app.Rounds',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bets') ? [] : ['className' => BetsTable::class];
        $this->Bets = TableRegistry::getTableLocator()->get('Bets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Bets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
