<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Ideas\Idea1;
use App\Model\Entity\Bet;
use App\Model\Entity\Game;
use App\Model\Entity\Round;
use App\Model\Table\RoundsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoundsTable Test Case
 *
 * @property GamesTable Games
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
        $this->Games = TableRegistry::getTableLocator()->get('Games');
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

    public function testCounterCache(): void
    {
        $game = new Game(['id' => 10]);
        $this->Games->saveOrFail($game);
        $round = new Round(['number' => 1]);
        $round->game = $game;
        $this->assertSame(1, $round->game->getCapacity());
        $round->bets = [
            new Bet(['bet' => 1, 'idea_name' => (new Idea1())->getName()]),
        ];

        $this->Rounds->saveOrFail($round);
        $game = $this->Games->get(10);
        $this->assertSame(1000.0, $game->earns);
        $this->assertSame(-0.1, $game->satisfactions);
    }
}
