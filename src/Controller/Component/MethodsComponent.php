<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Inflector;

/**
 * Methods component
 */
class MethodsComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param $destination
     * @param $imageData
     * @return bool|string
     */
    public function uploadImage($destination, $imageData)
    {
        $imageData['name'] =  time() . '-' . str_replace(' ', '-', $imageData['name']); // timestamp files to prevent clobber
        if (move_uploaded_file($imageData['tmp_name'], WWW_ROOT . $destination . '/' . $imageData['name'])) {
            return $imageData['name'];
        } else {
            return false;
        }
    }
}
