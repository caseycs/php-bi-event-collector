<?php
use EventCollector\PDOStorage;

class PDOStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDOStorage
     */
    private $storage;

    public function setUp()
    {
        return;
        $this->storage = new PDOStorage($pdo, 'events');
    }

    public function test_store()
    {
        $this->markTestIncomplete();
        $this->storage->store->event();
    }

}
