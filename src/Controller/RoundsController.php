<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Http\Response;

/**
 * Rounds Controller
 *
 * @property \App\Model\Table\RoundsTable $Rounds
 * @method \App\Model\Entity\Round[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoundsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        $redirect = parent::beforeFilter($event);
        $this->set('table', $this->game ? $this->game->nextTable() : null);

        return $redirect;
    }

    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index(): void
    {
    }

    /**
     * View method
     *
     * @param string|null $id Round id.
     * @return void Renders view
     */
    public function view($id = null): void
    {
        $round = $this->Rounds->get($id, [
            'contain' => ['Games', 'Bets'],
        ]);

        assert(!is_null($this->user));
        if ($round->game->user_id != $this->user->id) {
            throw new UnauthorizedException('Wrong user');
        }

        assert(!is_null($this->game));
        if (is_null($this->game->nextTable())) {
            $this->setResponse($this->response->withExpiredCookie(new Cookie('game_id')));
        }

        $this->set(compact('round'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(): ?Response
    {
        assert(!is_null($this->game));
        $round = $this->Rounds->newEmptyEntity();
        if ($this->request->is('post')) {
            $round->game = $this->game;

            $round = $this->Rounds->patchEntity($round, $this->request->getData());
            if ($this->Rounds->save($round)) {
                return $this->redirect(['action' => 'view', $round->id]);
            }
            $this->Flash->error(__('The round could not be saved. Please, try again.'));
        }
        $this->set(compact('round'));
        return null;
    }
}
