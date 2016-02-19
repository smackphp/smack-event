<?php

namespace Smack\Event;

class Dispatcher implements DispatcherInterface
{
	protected $events;

	public function __construct(EventCollectionInterface $events)
	{
		$this->events = $events;
	}

	public function dispatch(string $eventName, array $params = []):EventInterface
	{
		if (!$this->events->hasEvent($eventName)) {
			return false;
		}

		if (!$this->events->hasListeners($eventName)) {
			return false;
		}

		$event = $this->events->getEvent($eventName);
		$event->setDispatcher($this);
		
		foreach ($this->events->getListeners($eventName) as $listener) {
			$event = $this->doDispatch($event, $listener, $params);
		}

		return $event;
	}

	public function doDispatch(EventInterface $event, $listener, array $params = [])
	{
		array_unshift($params, $event);

		if (is_string($listener)) {
			$result = call_user_func_array([new $listener, '__invoke'], $params);
		} elseif (is_callable($listener)) {
			$result = call_user_func_array($listener, $params);
		} else {
			throw new Exception('unable to dispatch '.var_dump($listener));
		}

		return $result;

	}

	public function getEvents():EventCollectionInterface
	{
		return $this->events;
	}
}