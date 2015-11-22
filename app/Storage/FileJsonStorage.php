<?php
namespace BiEventCollector\Storage;

use BiEventCollector\BiEventInterface;
use BiEventCollector\BiEventStorageInterface;
use Exception;

class FileJsonStorage implements BiEventStorageInterface
{
    private $filePath;

    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function store(BiEventInterface $event)
    {
        $eventArray = [
            'actor' => $event->getActor(),
            'actor_id' => $event->getActorId(),
            'action' => $event->getAction(),
            'subject' => $event->getSubject(),
            'subject_id' => $event->getSubjectId(),
            'meta' => $event->getMeta(),
            'createdAt' => $event->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        if (!error_log(json_encode($eventArray) . PHP_EOL, 3, $this->filePath)) {
            throw new Exception(sprintf('error_log with destination %s failed', $this->filePath));
        }
    }
}
