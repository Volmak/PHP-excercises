<?php

namespace Post;

use Interfaces\IMailer;
use Mail\Parcel;
use Mail\Letter;

class PostBox implements IMailer
{
	
	use \Interfaces\MailerTrait{
		receiveMail as receiveMailTrait;
	}

	public function receiveMail($mails)
	{
		$return = [];
		$receive = [];
		foreach ($mails as $mail){
			if ($mail instanceof Parcel){
				$return [] = $mail;
			}
			if ($mail instanceof Letter){
				$receive [] = $mail;
			}
		}
		$this->receiveMailTrait($receive);
		return $return;
	}
}