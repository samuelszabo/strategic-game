<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Cookie\Cookie;
use DateTime;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Games'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $cookie = (new Cookie('user_id'))
                    ->withValue((string)$user->id)
                    ->withExpiry(new DateTime('+1 year'))
                    ->withSecure(false) //todo
                    ->withHttpOnly(true);
                $this->setResponse($this->response->withCookie($cookie));

                return $this->redirect(['controller' => 'Games', 'action' => 'add']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function logout()
    {
        $this->setResponse($this->response->withExpiredCookie(new Cookie('user_id'))->withExpiredCookie(new Cookie('game_id')));
        $this->redirect('/');
    }
}
