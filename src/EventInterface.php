<?php

namespace Smack\Event;

interface EventInterface
{
	public function getName():string;
	public function getDispatcher():DispatcherInterface;
}