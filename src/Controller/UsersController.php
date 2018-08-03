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
        $this->viewBuilder()->setLayout('users');
        $this->set('activity', 'index');
    }

    /**
     *
     */
    public function profile()
    {
        $this->set('module', 'profile');
    }

    /**
     *
     */
    public function settings()
    {
        $this->set('module', 'settings');
    }

    /**
     *
     */
    public function login()
    {
        if ($this->Auth->User()) {
            return $this->redirect('/dashboard');
        }
        $this->viewBuilder()->setLayout('auth');
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
        if ($this->authUser->role->name == 'Admin') {
            return $this->redirect('/admin/dashboard');
        }

        $module = 'dashboard';
        $this->viewBuilder()->setLayout($module);
        $this->set(compact('module'));
        $this->set('activity', 'index');
    }
}
