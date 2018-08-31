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
        if ($this->request->params['prefix'] == 'admin' && $this->authUser->role->name != 'Admin') {
            $this->Flash->error(_('You are not allowed to access this URL'));

            return $this->redirect('/dashboard');
        } else {
            $module = 'users';
            $this->viewBuilder()->setLayout($module);
            $this->set(compact('module'));
            $this->set('activity', 'index');
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
     * @return \Cake\Http\Response|void renders view.
     */
    public function add()
    {
        $this->set('activity', 'add');
    }

    /**
     * Edit method
     *
     * @param string|null $slug User slug.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $this->set(compact('slug'));
        $this->set('activity', 'edit');
    }

    /**
     * function to render admin dashboard.
     */
    public function dashboard()
    {
        $module = 'dashboard';
        $this->viewBuilder()->setLayout($module);
        $this->set(compact('module'));
        $this->set('activity', 'index');
    }
}
