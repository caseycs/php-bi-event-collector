<?php
namespace EventCollector;

interface EventStorageInterface
{
    public function store(EventInterface $event);
}
