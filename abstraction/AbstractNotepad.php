<?php

abstract class AbstractNotepad
{
// 	abstract function addTextToPage();
	
// 	abstract function setTextOnPage();
	
// 	abstract function deleteTextOnPage();
	
// 	abstract function readAll();

	protected $pages;
	
	public function __construct(array $pages) //arrayof? why not?
	{
		foreach ($pages as $page){
			$this->addPage($page);
		}
	}
	
	public function getPages ()
	{
		return $this->pages;
	}

	public function addPage (Page $page)
	{
		$this->pages[] = $page;
	}
	
	public function addTextToPage(int $pageNumber,string $text)
	{
		$this->pages[$pageNumber]->addText($text);
	}
	
	public function setTextOnPage(int $pageNumber,string $text)
	{
		$this->pages[$pageNumber]->setText($text);
	}
	
	public function deleteTextOnPage(int $pageNumber, int $from = 0,int $numberOfChars = INF)
	{
		$this->pages[$pageNumber]->deleteText($from,$numberOfChars);
	}
	
	public function readAll()
	{
		$aLongString = '';
		foreach ($this->pages as $page){
			$aLongString .= $page->read() . PHP_EOL;
		}
		return $aLongString;
	}
	
	public function searchWord($word)
	{
		$matchesList = '';
		foreach ($this->pages as $page){
			$matchesList .= $page->searchWord($word) !== false ? $page->searchWord($word) : 'No matches';
			$matchesList .= PHP_EOL;
		}
		return $matchesList;
	}

 	public  function printAllPagesWithDigits()
 	{
 		foreach ($this->pages as $page){
			if($page->containsDigits()){
				echo $page->read() . PHP_EOL;
			}
		}
 	}
}