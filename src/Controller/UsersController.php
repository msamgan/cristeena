<?php
namespace App\Controller;

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
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('users');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null renders view.
     */
    public function add()
    {
    }

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

    /**
     *
     */
    public function profile()
    {

    }

    /**
     *
     */
    public function settings()
    {

    }

    /**
     *
     */
    public function login()
    {
        if ($this->Auth->User()) {
            return $this->redirect('/dashboard');
        }
        $this->viewBuilder()->layout('auth');
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $this->Flash->success(_('You are now logged out.'));
        return $this->redirect($this->Auth->logout());
    }

    public function dashboard()
    {
        $this->viewBuilder()->layout('dashboard');
        if ($this->authUser->role->name == 'Admin') {
            return $this->redirect('/admin/dashboard');
        }
    }
}
