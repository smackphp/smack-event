<?php

namespace Smack\Event;

interface EventCollectionInterface
{
	public function getEvent(string $eventName):EventInterface;
	public function getEvents():array;
	public function getListeners(string $eventName = null);
	public function hasListeners(string $eventName):bool;
	public function hasEvent(string $eventName):bool;
}