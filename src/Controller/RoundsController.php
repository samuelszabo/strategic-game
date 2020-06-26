<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Exception\UnauthorizedException;

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
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
    }

    /**
     * View method
     *
     * @param string|null $id Round id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $round = $this->Rounds->get($id, [
            'contain' => ['Games', 'Bets'],
        ]);

        if ($round->game->user_id != $this->user->id) {
            throw new UnauthorizedException('Wrong user');
        }

        if (is_null($this->game->nextTable())) {
            $this->setResponse($this->response->withExpiredCookie(new Cookie('game_id')));
        }

        $this->set(compact('round'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
    }
}
