<?php

namespace Smack\Event;

class Event implements EventInterface
{
	protected $name;
	protected $dispatcher;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function getName():string
	{
		return $this->name;
	}

	public function setDispatcher(Dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	public function getDispatcher():DispatcherInterface
	{
		return $this->dispatcher;
	}
}