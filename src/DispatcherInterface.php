<?php

namespace Smack\Event;

interface DispatcherInterface
{
	public function dispatch(string $eventName, array $params):EventInterface;
	public function getEvents():EventCollectionInterface;
}