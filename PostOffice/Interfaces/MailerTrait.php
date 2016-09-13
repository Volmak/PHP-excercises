<?php

namespace Interfaces;

use Interfaces\IMailer;
use Mail\Letter;

trait MailerTrait
{
	protected $mails = [];

	public function sendMail(IMailer $receiver)
	{
		$receiver->receiveMail($this->mails);
		$this->mails = [];
	}

	public function receiveMail($mail)
	{
		$this->mails = array_merge($this->mails, $mail);
	}

	public function getMailsInfo()
	{
		$mailsCount = count($this->mails);
		$lettersCount = 0;
		$parcelsCount = 0;
		foreach ($this->mails as $mail){
			$mail->getPrice() < 1 ? $lettersCount++ : $parcelsCount++;
		}
		return "$mailsCount mails: $lettersCount letters and $parcelsCount parcels";
	}
	
	public function isFull()
	{
		if (count($this->mails) > 0){
			return true;
		}
		return false;
	}
}