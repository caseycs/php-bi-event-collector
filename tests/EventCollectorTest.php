<?php
use BiEventCollector\EventCollector;
use BiEventCollector\BiEventStorageInterface;
use BiEventCollector\SimpleBiEvent;
use BiEventCollector\Storage\MemoryStorage;

class BiEventCollectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MemoryStorage|BiEventStorageInterface
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
        $event = new SimpleBiEvent(
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
