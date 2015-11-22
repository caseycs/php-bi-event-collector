<?php
namespace EventCollector;

use DateTime;

interface EventInterface
{
    /**
     * @return string
     */
    public function getActor();

    /**
     * @return string|int
     */
    public function getActorId();

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return string|int
     */
    public function getSubjectId();

    /**
     * @return array
     */
    public function getMeta();

    /**
     * @return DateTime
     */
    public function getCreatedAt();
}
