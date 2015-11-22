<?php
namespace EventCollector;

use EventCollector\Exception\StorageException;
use Exception;

class EventCollector
{
    /*
     * @var EventStorageInterface
     */
    private $eventStorage;

    /**
     * @param EventStorageInterface $eventStorage
     */
    public function __construct(EventStorageInterface $eventStorage)
    {
        $this->eventStorage = $eventStorage;
    }

    /**
     * @param EventInterface $event
     */
    public function send(EventInterface $event)
    {
        try {
            $this->eventStorage->store($event);
        } catch (Exception $e) {
            throw new StorageException('Event storing failed', 0, $e);
        }
    }
}
