<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\RoundsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\RoundsController Test Case
 *
 * @uses \App\Controller\RoundsController
 */
class RoundsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Rounds',
        'app.Games',
        'app.Users',
        'app.Bets',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->cookie('user_id', 1);
        $this->cookie('game_id', 1);
        $this->get('/rounds');
        $this->assertResponseOk();
    }


    public function testAddWithoutCookie(): void
    {
        $this->cookie('user_id', 1);
        $this->get('/rounds/add');
        $this->assertRedirect('/games/add');
    }


    public function testAdd(): void
    {
        $this->cookie('user_id', 1);
        $this->cookie('game_id', 1);
        $this->get('/rounds/add');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->cookie('user_id', 1);
        $this->cookie('game_id', 1);
        $this->get('/rounds/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
