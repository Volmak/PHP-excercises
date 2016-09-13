<?php

namespace People;

use Interfaces\IMailer;

abstract class AbstractPostMan extends Person implements IMailer
{
	protected $experience;
	protected $delivered;
	
	public function __construct(string $firstName, string $lastName, float $experience)
	{
		parent::__construct($firstName, $lastName);
		$this->experience = $experience;
		$this->delivered = 0;
	}
	
	use \Interfaces\MailerTrait{
		sendMail as sendMailTrait;
	}

	public function sendMail(IMailer $receiver)
	{
		$this->delivered += count($this->mails);
		$this->sendMailTrait($receiver);
	}
	
	public function getDelivered()
	{
		return $this->delivered;
	}
	
	public function getReport()
	{
		return $this->getFullName() . ': ' . $this->getDelivered();
	}
	
	public function getExperience()
	{
		return $this->experience;
	}
}