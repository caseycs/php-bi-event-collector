# EventCollector

[![Build Status](https://travis-ci.org/caseycs/php-event-collector.svg?branch=master)](https://travis-ci.org/caseycs/php-event-collector)

Simple interface to store PHP application events. Multiple storages support. 

## Requirements

* PHP 5.6

## Usage example

#### FileJsonStorage

We append events in file since it's very fast, an then we assume that `events.json` will be parsed and events will be
persisted in some storage.

```php
$storage = new FileJsonStorage('events.json');
$event = new SimpleEvent('user', 1, 'write','post', 5);
$storage->store($event);
```

#### PDOStorage

For the project without high load will be a great solution.


```sql
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `actor` varchar(255) NOT NULL DEFAULT '',
  `actor_id` int(10) unsigned NOT NULL,
  `action` varchar(10) DEFAULT '',
  `subject` varchar(255) DEFAULT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `meta` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

```php
$dsn = 'mysql:dbname=test;host=localhost';
$user = 'root';
$password = '';

$pdo = new PDO($dsn, $user, $password);
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$storage = new PDOStorage($pdo, 'events');
$event = new SimpleEvent('user', 1, 'write','post', 5);
$storage->store($event);
```

