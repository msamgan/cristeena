<?php
namespace Logan\Controller;

use Cake\Filesystem\File;
use Logan\Controller\AppController;

class LogsController extends AppController
{
    private $levels = [
        ' Info: ',
        ' Notice: ',
        ' Debug: ',
        ' Error: ',
        ' Warning: ',
        ' Critical: ',
        ' Alert: ',
        ' Emergency: '
    ];

    public function index()
    {

    }

    /**
     * @param $date
     */
    public function view($date)
    {
        $contents = $this->_getLogFileContent('debug', $date);
        $contents = array_merge($contents, $this->_getLogFileContent('error', $date));
        $contents = $this->_formatContent($contents);

        $this->set(compact('date', 'contents'));
    }

    /**
     * @param $level
     * @param $date
     * @return array|false|null|string|string[]
     */
    private function _getLogFileContent($level, $date)
    {
        if (!file_exists(LOGS . $level . '-' .$date . '.log')) {
            return [];
        }

        $file = new File(LOGS . $level . '-' .$date . '.log');

        $contents = $file->read();
        $file->close();

        $contents = array_values(array_filter(explode($date . ' ', $contents)));

        return preg_replace('/\s\s+/', ' ', $contents);
    }

    /**
     * @param $contents
     * @return array
     */
    private function _formatContent($contents)
    {
        $log = [];
        foreach ($this->levels as $level) {
            $levelKey = null;
            foreach ($contents as $key => $content) {
                if (strpos($content, $level)) {
                    $levelKey = substr(strtolower(trim($level)), 0, -1);
                    $log[$levelKey][] = $content;
                }
            }
            if ($levelKey) {
                $log[$levelKey] = array_reverse($log[$levelKey]);
            }
        }

        return $log;
    }
}
