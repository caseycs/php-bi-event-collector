# BiEventCollector

[![Build Status](https://travis-ci.org/caseycs/php-bi-event-collector.svg?branch=master)](https://travis-ci.org/caseycs/php-bi-event-collector)

Simple interface to store PHP application BI events. Multiple storage support. 

## Requirements

* PHP 5.6

## Usage examples

#### FileJsonStorage

We append events in file since it's very fast, an then we assume that `events.json` will be parsed and events will be
persisted in some storage.

```php
$storage = new FileJsonStorage('events.json');
$event = new SimpleBiEvent('user', 1, 'write','post', 5, ['title' => 'first post']);
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
$event = new SimpleBiEvent('user', 1, 'write', 'post', 5, ['title' => 'first post']);
$storage->store($event);
```

#### MemoryStorage

For test environment

## Advanced usage

Use `EventCollectorInterface` in your DI container and define your own event classes using `EventInterface`, for example:

```php
class UserLeftFeedbackBiEvent extends SimpleBiEvent implements BiEventInterface
{
    public function __construct($userId, $feedbackText)
    {
        $this->createdAt = new DateTime;
        $this->actor = 'user';
        $this->actorId = $userId;
        $this->action = 'createFeedback;
    }
    
}
```

or even more detailed:

```php
class UserLeftFeedbackBiEvent extends SimpleBiEvent implements BiEventInterface
{
    public function __construct($userId, $feedbackId, $feedbackText)
    {
        $this->createdAt = new DateTime;
        $this->actor = 'user';
        $this->actorId = $userId;
        $this->action = 'create';
        $this->subject = 'feedback';
        $this->subjectId = $feedbackId;
    }
    
}
```

Define your own DSL!
