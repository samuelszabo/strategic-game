<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Model\Entity\Game;
use App\Model\Entity\User;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\GamesTable $Games
 */
class AppController extends Controller
{
    protected ?User $user;
    protected ?Game $game;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('FormProtection');
        $this->loadModel('Users');
        $this->loadModel('Games');
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        I18n::setLocale('sk_SK');
        $this->user = $this->getUser();
        $this->game = $this->getGame();

        if (is_null($this->user) && !$this->isSetup()) {
            return $this->redirect(['controller' => 'Users', 'action' => 'add']);
        }
        if (is_null($this->game) && !$this->isSetup()) {
            return $this->redirect(['controller' => 'Games', 'action' => 'add']);
        }

        $this->set('user', $this->user);
        $this->set('game', $this->game);
    }

    /**
     * @return \App\Model\Entity\User|null
     */
    private function getUser(): ?User
    {
        $userId = $this->getRequest()->getCookie('user_id');
        if (!is_null($userId)) {
            return $this->Users->get((int)$userId);
        }

        return null;
    }

    /**
     * @return \App\Model\Entity\Game|null
     */
    private function getGame(): ?Game
    {
        $gameId = $this->getRequest()->getCookie('game_id');
        if (!is_null($gameId)) {
            return $this->Games->get((int)$gameId, ['contain' => ['Rounds.Bets']]);
        }

        return null;
    }

    /**
     * @return bool
     */
    private function isSetup(): bool
    {
        return in_array($this->getRequest()->getParam('controller'), ['Users', 'Games', 'Pages']);
    }
}
