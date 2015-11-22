<?php
use EventCollector\SimpleEvent;
use EventCollector\Storage\PDOStorage;

class PDOStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDO
     */
    private $conn;

    /**
     * @var PDOStorage
     */
    private $storage;

    public function setUp()
    {
        $dsn = 'mysql:dbname=test;host=localhost';
        $user = 'root';
        $password = '';

        $this->conn = new PDO($dsn, $user, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn->exec('DELETE FROM events');

        $this->storage = new PDOStorage($this->conn, 'events');
    }

    public function test_store()
    {
        $eventExpected = new SimpleEvent(
            'user',
            1,
            'write',
            'post',
            5,
            ['title' => "first\nevent"]
        );
        $this->storage->store($eventExpected);

        $events = $this->conn->query('SELECT * FROM events')->fetchAll(PDO::FETCH_ASSOC);
        $this->assertCount(1, $events);

        $event = reset($events);
        unset($event['created_at'], $event['id']);

        $eventExpected = [
            'actor' => 'user',
            'actor_id' => '1',
            'action' => 'write',
            'subject' => 'post',
            'subject_id' => '5',
            'meta' => json_encode(['title' => "first\nevent"]),
        ];
        $this->assertEquals($eventExpected, $event);
    }
}
