<?php

class Page
{
	protected $title;
	protected $text;
	
	public function __construct(string $title, string $text)
	{
		$this->title = $title;
		$this->text = $text;
	}
	
	public function addText (string $string)
	{
		$this->text .= $string;
	}
	
	public function setText (string $text)
	{
		$this->text = $text;
	}
	
	public function deleteText($from = 0,int $numberOfChars = 999999999)
	{
		$this->text = substr_replace($this->text, '', $from, $numberOfChars);
	}
	
	public function read ()
	{
		return $this->title . PHP_EOL . $this->text;
	}
	
	public function searchWord($word)
	{
		return strpos($this->text, $word);
	}
	
	public function containsDigits()
	{
		return preg_match('/\d/', $this->text);
	}
}
