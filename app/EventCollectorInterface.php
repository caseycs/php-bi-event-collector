<?php
namespace EventCollector;

use EventCollector\Exception\StorageException;

interface EventCollectorInterface
{
    /**
     * @param EventInterface $event
     * @throws StorageException
     */
    public function send(EventInterface $event);
}
