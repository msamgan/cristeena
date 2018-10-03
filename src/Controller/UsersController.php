<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController extends AppController
{
    /**
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
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
     * @return \Cake\Http\Response|null
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

    /**
     * @return \Cake\Http\Response|null
     */
    public function dashboard()
    {
        if ($this->authUser->role->name == 'Admin') {
            return $this->redirect('/admin/dashboard');
        }

        if ($this->authUser->role->name == 'Director') {
            return $this->redirect('/director/dashboard');
        }

        $module = 'dashboard';
        $this->viewBuilder()->setLayout($module);
        $this->set(compact('module'));
        $this->set('activity', 'index');
    }
}
