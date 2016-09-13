<?php

namespace Interfaces;

interface IMailer
{
	public function sendMail(IMailer $receiver);
	public function receiveMail($mails);
}