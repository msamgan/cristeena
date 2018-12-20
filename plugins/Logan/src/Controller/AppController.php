<?php

namespace Logan\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
}
