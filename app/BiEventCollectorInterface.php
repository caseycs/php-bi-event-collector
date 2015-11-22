<?php
namespace BiEventCollector;

use BiEventCollector\Exception\StorageException;

interface BiEventCollectorInterface
{
    /**
     * @param BiEventInterface $event
     * @throws StorageException
     */
    public function send(BiEventInterface $event);
}
