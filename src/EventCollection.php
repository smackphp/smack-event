<?php

namespace Smack\Event;

class EventCollection implements EventCollectionInterface
{
	protected $events;
	protected $listeners;

	public function addEvent(string $eventName, $event)
	{
		if (is_string($event)) {
			$event = new $event($eventName);
		}

		if (!$event instanceOf EventInterface) {
			return false;
		}

		$this->events[$event->getName()] = $event;
		return $this;
	}

	public function addEvents(array $events)
	{
		foreach ($events as $name => $event) {
			$this->addEvent($name, $event); 
		}

		return $this;
	}

	public function getEvent(string $eventName):EventInterface
	{
		return $this->events[$eventName];
	}

	public function getEvents():array
	{
		return $this->events;
	}

	public function hasEvent(string $eventName):bool
	{
		return isset($this->events[$eventName]);
	}

	public function addListener(string $eventName, $listener)
	{
		$this->listeners[$eventName] = $listener;
		return $this;
	}

	public function addListeners(string $eventName, array $listeners)
	{
		if (isset($this->listeners[$eventName])) {
			$this->listeners[$eventName] = array_merge($this->listeners[$eventName], $listeners);
		} else {
			$this->listeners[$eventName] = $listeners;
		}

		return $this;
	}

	public function getListeners(string $eventName = null)
	{
		if ($eventName === null) {
			return $this->listeners;
		} else {
			return $this->listeners[$eventName];
		}
	}

	public function hasListeners(string $eventName):bool
	{
		if (!empty($this->listeners[$eventName])) {
			return true;
		} else {
			return false;
		}
	}
}