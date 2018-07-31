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
     * @param string $string
     * @param bool $edit
     * @param bool $oldSlug
     * @return string
     */
    public function slug($string = '', $edit = false, $oldSlug = false)
    {
        if (empty($string)) {
            $string = 'unique-slug';
        }

        if (!$edit) {
            return strtolower(Inflector::slug($string))."-".time();
        }

        return strtolower(Inflector::slug($string))."-".@end(explode('-', $oldSlug));
    }
}
