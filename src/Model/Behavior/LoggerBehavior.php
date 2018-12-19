<?php
namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * Logger behavior
 */
class LoggerBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param Event $event
     * @param EntityInterface $entity
     */
    public function afterSave(Event $event, EntityInterface $entity)
    {
        $message = 'Entity ' . $entity->getSource() . ' Saved : ' . json_encode($entity);
        if ($entity->isNew()) {
            $message = 'New '. $message;
        }

        log::write('info', $message);
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     */
    public function afterDelete(Event $event, EntityInterface $entity)
    {
        log::write('info', 'Entity ' . $entity->getSource() . ' Deleted : ' . json_encode($entity));
    }
}
