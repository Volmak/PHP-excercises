<?php

class SecuredNotepad extends AbstractNotepad
{
	protected $password;
	
	public function __construct($password, array $pages)
	{
		if (!$this->securePaswword($password)){
			throw new Exception('Password is too weak!');
		}
		$this->password = $password;
		foreach ($pages as $page){
			$this->constructPages($page);
		}
	}
	
	protected function securePaswword($password)
	{
		if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $password)){
			return true;
		}
		return false;
	}
/*
SecuredNotepad,
 така че всеки
 защитен бележник да изисква задаване на силна парола при
 създаването си. Под силна парола се разбира парола с поне 5 символа,
 с поне една малка буква, голяма буква и число.П
 роменете класа
 „ИТ Таланти“ ООД
 ул.
 “
 Софийски герой” No1, ет. 11
 София 1612
 www.ittalents.bg
 тел.: +359
 888
 911 186
 SecuredNotepad,
 че ако при създаването не се въведе силна парола, да
 не се създава обект от тип
 SecuredNotepad
 */
	
	protected function constructPages (Page $page)
	{
		parent::addPage($page);
	}
	
	protected function checkPassword()
	{
		if (isset($_GET['password']) && $_GET['password'] == $this->password){ 
			return true;
		}
// 		throw new Exception('Invalid password!');
		return false;
	}
	
	public function addPage (Page $page)
	{
		if ($this->checkPassword()){
			parent::addPage($page);
		}
	}
	
	public function addTextToPage(int $pageNumber,string $text)
	{
		if ($this->checkPassword()){
			parent::addTextToPage($pageNumber, $text);
		}
	}
	
	public function setTextOnPage(int $pageNumber,string $text)
	{
		if ($this->checkPassword()){
			parent::setTextOnPage($pageNumber, $text);
		}
	}
	
	public function deleteTextOnPage(int $pageNumber, int $from = 0,int $numberOfChars = INF)
	{
		if ($this->checkPassword()){
			parent::deleteTextOnPage($pageNumber, $from, $numberOfChars);
		}
	}
	
	public function readAll()
	{
		if ($this->checkPassword()){
			return parent::readAll();
		}
	}
}