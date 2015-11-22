<?php
namespace BiEventCollector\Storage;

use BiEventCollector\BiEventInterface;
use BiEventCollector\BiEventStorageInterface;
use PDO;
use PDOStatement;

class PDOStorage implements BiEventStorageInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var PDOStatement
     */
    private $statement;

    /**
     * @var string
     */
    private $table;

    /**
     * @param PDO $pdo
     * @param string $table
     */
    public function __construct(PDO $pdo, $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    /**
     * @param BiEventInterface $event
     */
    public function store(BiEventInterface $event)
    {
        if ($this->statement === null) {
            $sql = 'INSERT INTO %s SET actor = :actor, actor_id = :actor_id, action = :action,
              subject = :subject, subject_id = :subject_id, meta = :meta, created_at = :created_at';
            $sql = sprintf($sql, $this->table);
            $this->statement = $this->pdo->prepare($sql);
        }

        $this->statement->bindValue('actor', $event->getActor());
        $this->statement->bindValue('actor_id', $event->getActorId());
        $this->statement->bindValue('action', $event->getAction());
        $this->statement->bindValue('subject', $event->getSubject());
        $this->statement->bindValue('subject_id', $event->getSubjectId());
        $this->statement->bindValue('created_at', $event->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->statement->bindValue('meta', json_encode($event->getMeta()));

        $this->statement->execute();
    }
}
