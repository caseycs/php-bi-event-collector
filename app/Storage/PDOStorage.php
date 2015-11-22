<?php
namespace EventCollector\Storage;

use PDO;
use PDOStatement;

class PDOStorage implements EventStorageInterface
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

    public function store(EventInterface $event)
    {
        $sql = sprintf('INSERT INTO %s SET actor = :actor, actor_id = :actor_id, action = :action,
          subject = :subject, subject_id = :subject_id, created_at = :created_at', $this->table);
        $this->statement = $this->pdo->prepare($sql);

        $this->statement->bindValue('actor', $event->getActor());
        $this->statement->bindValue('actor_id', $event->getActorId());
        $this->statement->bindValue('action', $event->getAction());
        $this->statement->bindValue('subject', $event->getSubject());
        $this->statement->bindValue('subject_id', $event->getSubjectId());
        $this->statement->bindValue('created_at', $event->getCreatedAt()->format('Y-m-d H:i:s'));

        $this->pdo->exec($this->statement);
    }
}
