<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\GamesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\GamesController Test Case
 *
 * @uses \App\Controller\GamesController
 */
class GamesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Games',
        'app.Users',
        'app.Rounds',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAddWithoutUser(): void
    {
        $this->get('/games/add');
        $this->assertRedirect('/users/add');
    }

    public function testAdd(): void
    {
        $this->cookie('user_id', 1);
        $this->get('/games/add');
        $this->assertResponseOk();
    }

    public function testAddPost(): void
    {
        $this->cookie('user_id', 1);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/games/add', ['name' => 'Test1']);
        $this->assertRedirect('/rounds');
        $this->assertCookie('2', 'game_id');
    }
}

