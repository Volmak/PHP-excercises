<?php

namespace Mail;

class Letter extends AbstractMail
{
	const PRICE = 0.5;
	
	public function getPrice()
	{
		return self::PRICE;
	}
}