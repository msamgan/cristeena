<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Class UsersController
 * @package App\Controller\Api
 */
class UsersController extends AppController
{
    /**
     * role id of admin in roles table
     */
    const ADMIN_ROLE_ID = 2;
    /**
     * role id of user in roles table
     */
    const USER_ROLE_ID = 3;

    /**
     * containing the model of the controller class.s
     */
    private $model;

    /**
     * @param Event $event
     * @return \Cake\Http\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'login'
        ]);
        $this->autoRender = false;

        $this->model = $this->Users;
    }

    /**
     * listing all the users with admin and director actions ( as per login user. )
     */
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
            'maxLimit' => self::PAGINATION_MAX_LIMIT,
            'limit' => $this->model
                ->find('all')
                ->count()
        ];

        $users = $this->paginate($this->model);
        $count = 1;
        foreach ($users as $user) {
            $user->count = $count;
            $user->actions = ($this->authUser->role->name === 'Director')
                ? $user->director_user_actions
                : $user->admin_user_actions;
            $count++;
        }

        $response['data'] = $users;

        $this->_throw($response);
    }

    /**
     *listing all admins with director actions
     */
    public function admins()
    {
        $this->paginate = [
            'contain' => ['Roles'],
            'conditions' => [
                'Users.role_id' => self::ADMIN_ROLE_ID
            ],
            'order' => [
                'Users.id' => 'DESC'
            ],
            'maxLimit' => self::PAGINATION_MAX_LIMIT,
            'limit' => $this->model
                ->find('all')
                ->count()
        ];

        $users = $this->paginate($this->model);
        $count = 1;
        foreach ($users as $user) {
            $user->count = $count;
            $user->actions = $user->director_admin_actions;
            $count++;
        }

        $response['data'] = $users;

        $this->_throw($response);
    }

    /**
     * @param $slug
     */
    public function view($slug)
    {
        $user = $this->model->findBySlug($slug)->first();

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
     * add user to system
     */
    public function add()
    {
        $user = $this->model->newEntity();
        if ($this->request->is('post')) {
            $request = $this->request->getData();

            /**
             * If email already exist
             */
            if (!empty($this->model->findByEmail($request['email'])->first())) {
                $response = [
                    'status' => false,
                    'title' => _('Email already used'),
                    'message' => _('It seems like there is already a user with this email. Try other email.')
                ];

                $this->_throw($response);
            }

            if (!empty($request['profile_image'])) {
                $request['profile_image'] = $this->Methods->uploadImage(
                    'img/profile',
                    $request['profile_image']
                );
            } else {
                $request['profile_image'] = 'profile.jpeg';
            }

            $user = $this->model->patchEntity($user, $request);
            if ($this->model->save($user)) {
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
     * @param $slug
     */
    public function edit($slug)
    {
        $user = $this->model->findBySlug($slug)->first();
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $request = $this->getRequest()->getData();

            if (isset($request['email'])) {
                /**
                 * If email already exist
                 */
                $existingUser = $this->model->findByEmail($request['email'])->first();
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

            $user = $this->model->patchEntity($user, $request);
            if ($this->model->save($user)) {
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

    /**
     *
     */
    public function login()
    {
        if ($this->getRequest()->is('post')) {
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
                    'message' => _('Invalid email or password OR you have been deactivated.')
                ];
            }

            $this->_throw($response);
        }
    }

    /**
     *
     */
    public function changePassword()
    {
        if ($this->getRequest()->is('post')) {
            $newPassword = $this->getRequest()->getData()['new_password'];
            $this->getRequest()->data('email' , $this->authUser->email);
            $user = $this->Auth->identify();
            if ($user) {
                $user = $this->model->get($user['id']);
                $user->password = $newPassword;
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
     * @param null $id
     */
    public function delete($id = null)
    {

        $this->getRequest()->allowMethod(['get']);
        try {
            $user = $this->model->get($id);
            if ($this->model->delete($user)) {
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
        } catch (\Exception $e) {
            $this->_throw([
                'status' => false,
                'title' => _('The user can not been deleted.'),
                'message' => _('user is in use, can not delete user.')
            ]);
        }

        $this->_throw($response);
    }
}
