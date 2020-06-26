<?php
declare(strict_types=1);

namespace App\Controller;

use App\Lib\CompanyNameGenerator;
use App\Model\Entity\Game;
use Cake\Event\EventInterface;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Response;
use DateTime;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 * @method \App\Model\Entity\Game[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GamesController extends AppController
{
    /**
     * @param \Cake\Event\EventInterface $event
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter(EventInterface $event)
    {
        $return = parent::beforeFilter($event);
        if (is_null($this->user)) {
            return $this->redirect(['controller' => 'Users', 'action' => 'add']);
        }

        return $return;
    }

    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index(): void
    {
        assert(!is_null($this->user));
        $games = $this->Games->find()
            ->contain(['Users'])->where(['rounds_count' => count(Game::$tables)])->orderDesc('points')
            ->limit(10);
        $myGames = $this->Games->find()->contain(['Users'])->where([
            'user_id' => $this->user->id,
            'rounds_count' => count(Game::$tables),
        ])->orderDesc('points')->limit(10);

        $this->set(compact('games', 'myGames'));
    }

    /**
     * View method
     *
     * @param string|null $id Game id.
     * @return void Renders view
     */
    public function view($id = null): void
    {
        $game = $this->Games->get($id, ['contain' => ['Users', 'Rounds'],]);

        $this->set(compact('game'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(): ?Response
    {
        $game = $this->Games->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (empty($data['name'])) {
                $data['name'] = $data['fallbackName'];
            }
            $game = $this->Games->patchEntity($game, $data);
            if ($this->Games->save($game)) {
                $cookie = (new Cookie('game_id'))->withValue((string)$game->id)
                    ->withExpiry(new DateTime('+1 year'))->withSecure(false) //todo
                    ->withHttpOnly(true);
                $this->setResponse($this->response->withCookie($cookie));

                $this->Flash->success(__('The game has been saved.'));

                return $this->redirect(['controller' => 'Rounds', 'action' => 'index']);
            }
            $this->Flash->error(__('The game could not be saved. Please, try again.'));
        }

        $generator = new CompanyNameGenerator();
        $companyNames = $generator->generate(3);

        $this->set(compact('game', 'companyNames'));

        return null;
    }

    public function reset(): ?Response
    {
        $this->setResponse($this->response->withExpiredCookie(new Cookie('game_id')));

        return $this->redirect(['action' => 'add']);
    }
}
