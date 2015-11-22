<?php
namespace BiEventCollector;

interface BiEventStorageInterface
{
    public function store(BiEventInterface $event);
}
