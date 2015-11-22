<?php
namespace BiEventCollector\Storage;

use BiEventCollector\BiEventInterface;
use BiEventCollector\BiEventStorageInterface;

class MemoryStorage implements BiEventStorageInterface
{
    private $events;

    public function store(BiEventInterface $event)
    {
        $this->events[] = $event;
    }

    /**
     * @return BiEventInterface[]
     */
    public function getEvents()
    {
        return $this->events;
    }
}
