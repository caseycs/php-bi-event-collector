<?php
use BiEventCollector\Storage\FileJsonStorage;
use BiEventCollector\SimpleBiEvent;

class FileJsonStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var FileJsonStorage
     */
    private $storage;

    /**
     * @var string
     */
    private $path;

    public function setUp()
    {
        $this->path = realpath(__DIR__ . '/../') . '/events.json';
        if (is_file($this->path)) {
            unlink($this->path);
        }
        $this->storage = new FileJsonStorage($this->path);
    }

    public function test_store()
    {
        $event = new SimpleBiEvent(
            'user',
            1,
            'write',
            'post',
            5,
            ['title' => "first\nevent"]
        );
        $this->storage->store($event);

        $content = trim(file_get_contents($this->path));
        $events = explode(PHP_EOL, $content);

        $event = json_decode($events[0], true);
        unset($event['createdAt']);

        $eventExpected = [
            'actor' => 'user',
            'actor_id' => 1,
            'action' => 'write',
            'subject' => 'post',
            'subject_id' => 5,
            'meta' => ['title' => "first\nevent"]
        ];
        $this->assertEquals($eventExpected, $event);
    }

}
