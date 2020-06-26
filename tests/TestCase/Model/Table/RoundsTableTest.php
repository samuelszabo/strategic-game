<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\Bet;
use App\Model\Entity\Game;
use App\Model\Entity\Round;
use App\Model\Table\RoundsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoundsTable Test Case
 */
class RoundsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoundsTable
     */
    protected $Rounds;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Rounds',
        'app.Games',
        'app.Bets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Rounds') ? [] : ['className' => RoundsTable::class];
        $this->Rounds = TableRegistry::getTableLocator()->get('Rounds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Rounds);

        parent::tearDown();
    }

    public function testBetsSummary(): void
    {
        $round = new Round();
        $round->game = new Game();
        $this->assertSame(1, $round->game->getCapacity());
        $round->bets = [
            new Bet(['bet' => 0.8]),
            new Bet(['bet' => 1.2]),
        ];

        $this->Rounds->save($round);
        $this->assertTrue($round->isNew());
        $this->assertSame(['bets' => ['ruleName' => 'Pridelená kapacita je vyššia ako dostupná']], $round->getErrors());
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
