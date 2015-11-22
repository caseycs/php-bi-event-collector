<?php
namespace BiEventCollector;

use DateTime;

class SimpleBiEvent implements BiEventInterface
{
    /**
     * @var string
     */
    private $actor;

    /**
     * @var string
     */
    private $actorId;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $subjectId;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var array
     */
    private $meta;

    /**
     * @param string $actor
     * @param string $actorId
     * @param string $action
     * @param string $subject
     * @param string $subjectId
     * @param DateTime $createdAt
     * @param array $meta
     */
    public function __construct($actor, $actorId, $action, $subject, $subjectId, array $meta = [])
    {
        $this->actor = $actor;
        $this->actorId = $actorId;
        $this->action = $action;
        $this->subject = $subject;
        $this->subjectId = $subjectId;
        $this->createdAt = new DateTime;
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * @return string
     */
    public function getActorId()
    {
        return $this->actorId;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
