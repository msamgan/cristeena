<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'users', 'action' => 'login']);
    $routes->connect('/login', ['controller' => 'users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'users', 'action' => 'logout']);
    $routes->connect('/dashboard', ['controller' => 'users', 'action' => 'dashboard']);
    $routes->connect('/profile', ['controller' => 'users', 'action' => 'profile']);
    $routes->connect('/settings', ['controller' => 'users', 'action' => 'settings']);

    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admin', function ($routes) {
    $routes->connect('/dashboard', ['controller' => 'users', 'action' => 'dashboard']);
    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('api', function ($routes) {
    $routes->connect('/login', ['controller' => 'users', 'action' => 'login']);
    $routes->fallbacks(DashedRoute::class);
});


/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
