<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.Games',
    ];

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->get('/users/add');
        $this->assertResponseOk();
    }

    public function testLogout(): void
    {
        $this->cookie('user_id', 1);
        $this->get('/users/logout');
        $this->assertRedirect();
        $this->assertCookieNotSet('user_id');
    }

    public function testAddPost(): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/users/add', ['name' => 'Test1']);
        $this->assertRedirect('/games/add');
        $this->assertCookie('2', 'user_id');
    }
}
