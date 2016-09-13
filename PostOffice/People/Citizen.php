<?php

namespace People;

use Post\PostStation;
use Interfaces\IMailer;


class Citizen extends Person implements IMailer
{
	const CHANCE = 2;
	
	protected $address;
	
	public function __construct(string $firstName, string $lastName, string $address)
	{
		parent::__construct($firstName, $lastName);
		
		$this->address = $address;
	}
	
	use \Interfaces\MailerTrait;
	
	public function sendMailAtRandom(PostStation $postStation)
	{
		$chance = rand(0, self::CHANCE);
		if ($chance == 0) {
			$this->sendMail($postStation);
		} else {
			$this->sendMail($postStation->getRandomPostBox());
		}
	}
	
	public function sendMail(IMailer $receiver)
	{
		$returned = $receiver->receiveMail($this->mails);
		$this->mails = $returned ? $returned : [];
	}
}