<?php

namespace Logan\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    /**
     * @param Event $event
     * @return \Cake\Http\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('dates', $this->_getLogDates());

    }

    /**
     * @return array
     */
    private function _getLogDates()
    {
        $re = '/(\d{8})|([0-9]{4}-[0-9]{2}-[0-9]{2})|([0-9]{2}-[0-9]{2}-[0-9]{4})/';
        $dates = [];
        foreach (glob(LOGS . 'debug-*.log') as $log) {
            preg_match($re, $log, $matches);
            array_push($dates, strtotime($matches[0]));
        }

        foreach (glob(LOGS . 'error-*.log') as $log) {
            preg_match($re, $log, $matches);
            array_push($dates, strtotime($matches[0]));
        }

        $dates = array_unique($dates);
        sort($dates);

        $sortedDates = [];
        foreach ($dates as $date) {
            array_push($sortedDates, date('Y-m-d', $date));
        }

        return array_reverse($sortedDates);
    }
}
