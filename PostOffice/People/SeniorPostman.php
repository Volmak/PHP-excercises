<?php

namespace People;

use Mail\Letter;
use Mail\Parcel;

class SeniorPostMan extends AbstractPostMan
{
	const LETTER_DELIVERY_TIME = 0; //instead of 10 minutes
	const PARCEL_DELIVERY_TIME = 1; //instead of 15 minutes
	//not really a good way since every posman waits for the last one to finish delivering... not sure if there is a good way in php
	public function deliver()
	{
		foreach ($this->mails as $index => $mail){
			if ($mail instanceof Letter){
				sleep(self::LETTER_DELIVERY_TIME);
			} else if ($mail instanceof Parcel) {
				sleep(self::PARCEL_DELIVERY_TIME);
			}
			$mail->getReceiver()->receiveMail([$this->mails[$index]]);
			unset($this->mails[$index]);
			$this->delivered++;
		}
	}
}
