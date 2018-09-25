<?php
namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\Utility\Inflector;
use Cake\ORM\Table;

/**
 * Slug behavior
 */
class SlugBehavior extends Behavior
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
            return strtolower(Inflector::slug($string)) . "-" . time();
        }

        return strtolower(Inflector::slug($string)) . "-" . @end(explode('-', $oldSlug));
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     */
    public function beforeSave(
        Event $event,
        EntityInterface $entity
    ) {
        if (empty($entity->slug)) {
            $slug = $this->slug($entity->name);
        } else {
            $slug = $this->slug(
                $entity->name,
                true,
                $entity->slug
            );
        }

        $entity->set(compact('slug'));
    }
}
