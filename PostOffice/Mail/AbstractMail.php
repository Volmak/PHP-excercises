<?php

namespace Mail;
use People\Citizen;

abstract class AbstractMail
{
	protected $sender;
	protected $receiver;
	
	public function __construct(Citizen $sender, Citizen $receiver)
	{
		$this->sender = $sender;
		$this->receiver = $receiver;
	}
	
	public function getSender()
	{
		return $this->sender;
	}
	
	public function getReceiver()
	{
		return $this->receiver;
	}
	
	abstract public function getPrice();
}