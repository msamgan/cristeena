<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    const USER_ROLE_ID = 2;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'login'
        ]);
        $this->autoRender = false;
    }

    public function index()
    {

        $this->paginate = [
            'contain' => ['Roles'],
            'conditions' => [
                'Users.role_id' => self::USER_ROLE_ID
            ],
            'order' => [
                'Users.id' => 'DESC'
            ],
            'limit' => $this->Users
                ->find('all')
                ->count()
        ];

        $users = $this->paginate($this->Users);
        $count = 1;
        foreach ($users as $user) {
            $user->count = $count;
            $user->actions = $user->actions;
            $count++;
        }

        $response['data'] = $users;

        $this->_throw($response);
    }

    /**
     * View method
     *
     * @param string|null $slug User slug.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $user = $this->Users->findBySlug($slug)->first();

        if (!empty($user)) {
            $response = [
                'status' => true,
                'user' => $user
            ];
        } else {
            $response = [
                'status' => false,
                'title' => _('No user with this slug'),
                'message' => _('It seems like there is no user with this slug.')
            ];
        }

        $this->_throw($response);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $request = $this->request->getData();

            /**
             * If email already exist
             */
            if (!empty($this->Users->findByEmail($request['email'])->first())) {
                $response = [
                    'status' => false,
                    'title' => _('Email already used'),
                    'message' => _('It seems like there is already a user with this email. Try other email.')
                ];

                $this->_throw($response);
            }

            $request['slug'] = $this->Methods->slug($request['name']);

            if (!empty($request['profile_image'])) {
                $request['profile_image'] = $this->Methods->uploadImage(
                    'img/profile',
                    $request['profile_image']
                );
            } else {
                $request['profile_image'] = 'profile.jpeg';
            }

            $user = $this->Users->patchEntity($user, $request);
            if ($this->Users->save($user)) {
                $response = [
                    'status' => true,
                    'title' => _('The user has been saved.'),
                    'message' => _('User has been saved in the system.')
                ];
            } else {
                $response = [
                    'status' => false,
                    'title' => _('User has not been saved'),
                    'message' => _('The user could not be saved. Please, try again.')
                ];
            }
        }

        $this->_throw($response);
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
        $user = $this->Users->findBySlug($slug)->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->request->getData();

            $request['slug'] = $this->Methods->slug($request['name'], true, $user->slug);

            if (isset($request['email'])) {
                /**
                 * If email already exist
                 */
                $existingUser = $this->Users->findByEmail($request['email'])->first();
                if (!empty($existingUser) && $user->id != $existingUser->id) {
                    $response = [
                        'status' => false,
                        'title' => _('Email already used'),
                        'message' => _('It seems like there is already a user with this email. Try other email.')
                    ];

                    $this->_throw($response);
                }
            }

            if (!empty($request['profile_image'])) {
                $request['profile_image'] = $this->Methods->uploadImage(
                    'img/profile',
                    $request['profile_image']
                );
            }

            $user = $this->Users->patchEntity($user, $request);
            if ($this->Users->save($user)) {
                $response = [
                    'status' => true,
                    'title' => _('The user has been updated.'),
                    'message' => _('User has been updated in the system.'),
                    'user' => $user
                ];
            } else {
                $response = [
                    'status' => false,
                    'title' => _('User has not been updated'),
                    'message' => _('The user could not be updated. Please, try again.')
                ];
            }
        }

        $this->_throw($response);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $response = [
                    'status' => true,
                    'title' => _('Authentication Success'),
                    'message' => _('login successful, redirecting to dashboard.')
                ];
            } else {
                $response = [
                    'status' => false,
                    'title' => _('Authentication Fail'),
                    'message' => _('Invalid email or password.')
                ];
            }

            $this->_throw($response);
        }
    }

    public function changePassword()
    {
        if ($this->request->is('post')) {
            $newPassword = $this->request->data['new_password'];
            unset($this->request->data['new_password']);
            unset($this->request->data['confirm_password']);
            $this->request->data['email'] = $this->authUser->email;
            $user = $this->Auth->identify();
            if ($user) {
                $user = $this->Users->get($user['id']);
                $user->password = $newPassword;
                $this->Users->save($user);
                $response = [
                    'status' => true,
                    'title' => _('Password Changed'),
                    'message' => _('Your password has been changed successfully')
                ];
            } else {
                $response = [
                    'status' => false,
                    'title' => _('Password Changed Fail'),
                    'message' => _('your current password is not correct.')
                ];
            }

            $this->_throw($response);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $response = [
                'status' => true,
                'title' => _('The user has been deleted.'),
                'message' => _('The user has been deleted from the system.')
            ];
        } else {
            $response = [
                'status' => false,
                'title' => _('The user has not been deleted.'),
                'message' => _('The user could not be deleted. Please, try again.')
            ];
        }

        $this->_throw($response);
    }
}
