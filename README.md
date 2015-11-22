# EventCollector

Simple interface to store PHP application events. Multiple storages support. 

## Requirements

* PHP 5.6

## Usage example

```php
$storage = new FileJsonStorage('events.json');
$event = new SimpleEvent('user', 1, 'write','post', 5);
$storage->store($event);
```
