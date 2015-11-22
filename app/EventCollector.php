<?php
namespace BiEventCollector;

use BiEventCollector\Exception\StorageException;
use Exception;

class EventCollector implements BiEventCollectorInterface
{
    /*
     * @var EventStorageInterface
     */
    private $eventStorage;

    /**
     * @param BiEventStorageInterface $eventStorage
     */
    public function __construct(BiEventStorageInterface $eventStorage)
    {
        $this->eventStorage = $eventStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function send(BiEventInterface $event)
    {
        try {
            $this->eventStorage->store($event);
        } catch (Exception $e) {
            throw new StorageException('Event storing failed', 0, $e);
        }
    }
}
