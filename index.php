<?php

require('vendor/autoload.php');

use \Smack\Event\EventCollection;
use \Smack\Event\Dispatcher;

$events = new EventCollection;
$events->addEvents([
	'boot' => '\Smack\Event\Event'
]);

$events->addListeners('boot', [
	function ($event, $text) {
		echo $text;
		return $event;
	}
]);

$dispatcher = new \Smack\Event\Dispatcher($events);
$event = $dispatcher->dispatch('boot', ['Hello World!']);