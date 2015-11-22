<?php
use EventCollector\EventCollector;
use EventCollector\EventStorageInterface;
use EventCollector\Storage\FileJsonStorage;
use EventCollector\SimpleEvent;
use EventCollector\Storage\MemoryStorage;

class EventCollectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MemoryStorage|EventStorageInterface
     */
    private $storage;

    /**
     * @var EventCollector
     */
    private $eventCollector;

    public function setUp()
    {
        $this->storage = new MemoryStorage();
        $this->eventCollector = new EventCollector($this->storage);
    }

    public function test_store()
    {
        $event = new SimpleEvent(
            'user',
            1,
            'write',
            'post',
            5,
            ['title' => "first\nevent"]
        );
        $this->eventCollector->send($event);

        $this->assertSame([$event], $this->storage->getEvents());
    }

}
