<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * @param Event $event
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('users');

        if ($this->request->params['prefix'] == 'admin' && $this->authUser->role->name != 'Admin') {
            $this->Flash->error(_('You are not allowed to access this URL'));
            return $this->redirect('/dashboard');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null renders view.
     */
    public function add() {}

    /**
     * Edit method
     *
     * @param string|null $slug User slug.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $this->set(compact('slug'));
    }

    public function dashboard()
    {
        $this->viewBuilder()->setLayout('dashboard');
    }
}
