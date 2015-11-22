<?php
namespace EventCollector\Storage;

use EventCollector\EventInterface;
use EventCollector\EventStorageInterface;
use Exception;

class FileJsonStorage implements EventStorageInterface
{
    private $filePath;

    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function store(EventInterface $event)
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
