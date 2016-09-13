<?php

// abstract class AbstractЕlectronicDevice extends SecuredNotepad
abstract class AED extends SecuredNotepad
// This is a great place to use an interface, but I'm doing abstractions only now...
{
	protected $isStarted = false;
	
	public function start()
	{
		$this->isStarted = true;
	}
	
	public function stop()
	{
		$this->isStarted = false;
	}
	
	public function isStarted()
	{
		return $this->isStarted;
	}
}