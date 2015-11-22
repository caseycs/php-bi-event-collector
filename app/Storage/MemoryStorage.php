<?php
namespace EventCollector\Storage;

use EventCollector\EventInterface;
use EventCollector\EventStorageInterface;

class MemoryStorage implements EventStorageInterface
{
    private $events;

    public function store(EventInterface $event)
    {
        $this->events[] = $event;
    }

    /**
     * @return EventInterface[]
     */
    public function getEvents()
    {
        return $this->events;
    }
}
