<?php

class ElectronicSecuredNotepad extends AED
// class ElectronicSecuredNotepad extends AbstractЕlectronicDevice
{	
	public function start()
	{
		if ($this->checkPassword()){
			parent::start();
		}
	}
	
	public function stop()
	{
		if ($this->checkPassword()){
			parent::stop();
		}
	}
	
	public function isStarted()
	{
		if ($this->checkPassword()){
			return parent::isStarted();
		}
	}
	
	public function addPage (Page $page)
	{
		if ($this->isStarted()){
			parent::addPage($page);
		}
	}
	
	public function addTextToPage(int $pageNumber,string $text)
	{
		if ($this->isStarted()){
			parent::addTextToPage($pageNumber, $text);
		}
	}
	
	public function setTextOnPage(int $pageNumber,string $text)
	{
		if ($this->isStarted()){
			parent::setTextOnPage($pageNumber, $text);
		}
	}
	
	public function deleteTextOnPage(int $pageNumber, int $from = 0,int $numberOfChars = INF)
	{
		if ($this->isStarted()){
			parent::deleteTextOnPage($pageNumber, $from, $numberOfChars);
		}
	}
	
	public function readAll()
	{
		if ($this->isStarted()){
			return parent::readAll();
		}
	}
}