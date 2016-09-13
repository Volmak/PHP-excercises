<?php

namespace Post;

use People\PostmanFactory;
use Interfaces\IMailer;
use Mail\Letter;
use Mail\Parcel;

class PostStation implements IMailer
{
	const NUMBER_OF_POSTBOXES = 25;
	const NUMBER_OF_JUNIORS = 3;
	const NUMBER_OF_SENIORS = 5;
	const STORAGE_CAPACITY = 50;
	const COLLECTION_TIME = 5; //10 sec instead of 2 hours

	private $postboxes = [];	
	private $juniors = [];	
	private $seniors = [];
	private $freeSeniors = [];
	private $archive = [];
	
	use \Interfaces\MailerTrait{
		receiveMail as receiveMailTrait;
	}
	public function sendMail(IMailer $NeRaboti){} // Next time I'll use two interfaces instead of just one...

    private static $instance;
    
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }
        return static::$instance;
    }
    
    protected function __construct()
    {
    	$this->placePostBoxes();
    	$this->hirePostmen();
    }
    
    private function __clone() {}

    private function __wakeup() {}
	
	private function placePostBoxes()
	{
		for ($i = 0; $i < static::NUMBER_OF_POSTBOXES; $i++) {
			$this->postboxes[] = new PostBox();
		}
	}
	
	private function hirePostmen() 
	{
		for ($i = 0; $i < static::NUMBER_OF_JUNIORS; $i++) {
			$this->juniors[] = PostmanFactory::createRandomJuniorPostman();
		}
		for ($i = 0; $i < static::NUMBER_OF_SENIORS; $i++) {
			$this->seniors[] = PostmanFactory::createRandomSeniorPostman();
		}
		$this->freeSeniors = $this->seniors;
	}
	
	public function getPostBoxes()
	{
		return $this->postboxes;
	}
	
	public function getRandomPostBox()
	{
		$key = array_rand($this->postboxes);
		return $this->postboxes[$key];
	}

	public function receiveMail($mails)
	{
		$this->receiveMailTrait($mails);
		$this->archive($mails);
	}
	
	public function chooseAction ()//whatNext()
	{
		if (count($this->mails) >= self::STORAGE_CAPACITY){
			$this->deliver();
		}
		if (count($this->mails) <= self::STORAGE_CAPACITY){
			$this->collect();
		}
	}
	
	public function collect()
	{
		foreach ($this->postboxes as $postbox){
			$postman = $this->juniors[array_rand($this->juniors)];
			$postbox->sendMail($postman);
		}
		sleep(self::COLLECTION_TIME);
		foreach ($this->juniors as $postman){
			$postman->sendMail($this);
		}
// 		$this->whatNext();
		// a stupid way to do this, but it's kind of realistic, right?
	}
	
	public function deliver()
	{
// 		if (count($this->freeSeniors == 0)){
// 			$this->whatNext();
// 			return;
// 		}
		$numberOfMails = count($this->mails) / count($this->freeSeniors);
		foreach ($this->freeSeniors as $postman){
			$postman->receiveMail(array_slice($this->mails, -$numberOfMails));
			array_splice($this->mails, -$numberOfMails);
			$postman->deliver();
		}
// 		$this->freeSeniors = [];
// 		$this->whatNext();
	}
	
	public function archive($mails)
	{
		$day = date('Y-m-d');
		$hour = date('H-i-s');
		if (isset($this->archive[$day][$hour])){
			$this->archive[$day][$hour] = array_merge($this->archive[$day][$hour], $mails);
		} else {
			$this->archive[$day][$hour] = $mails;
		}
	}
	
	/**
	 * $date in 'Y-m-d' format
	 */
	public function getArchiveFromDate(string $date)
	{
		if (isset($this->archive[$date])){
			return $this->archive[$date];
		}
		echo 'Invalid $date';
	}
	
	public function printArchiveFromDate(string $date)
	{
		$forTheDay = $this->getArchiveFromDate($date);
		foreach ($forTheDay as $hour => $array){
			echo $hour . ':' . PHP_EOL;
			foreach ($array as $mail){

				echo 'To: ' . $mail->getReceiver()->getFullName() . '	';
				echo 'From: ' . $mail->getSender()->getFullName() . '	';
				echo 'Price:' . $mail->getPrice() . PHP_EOL;
			}
			echo PHP_EOL;
		}
	}
	
	public function getLettersPercentFromDate(string $date = '')
	{
		if (!$date) {
			$date = date('Y-m-d');
		}
		
		$archive = $this->getArchiveFromDate($date);
		
		if(!$archive) { return; }

		$letters = $count = 0;
		foreach ($archive as $perHourArchive) {
			foreach ($perHourArchive as $mail) {
				if ($mail instanceof Letter) {
					$letters++;
				}
				$count++;
			}
		}
		return 100 * $letters / $count;
	}
	
	public function getFragilePercentFromDate(string $date = '')
	{
		if (!$date) {
			$date = date('Y-m-d');
		}
		$archive = $this->getArchiveFromDate($date);
		
		if(!$archive) { return; }

		$fragile = $parcels = 0;
		foreach ($archive as $perHourArchive) {
			foreach ($perHourArchive as $mail) {
				if ($mail instanceof Parcel) {
					$parcels++;
					
					if ($mail->getIsFragile()) {
						$fragile++;
					}
				}
			}
		}
		return 100 * $fragile / $parcels;
	}
	
	public function getPostmensDelivered()
	{
		$this->sortByDelivered($this->juniors);
		$this->sortByDelivered($this->seniors);
		
		$asString = 'Juniors:' . PHP_EOL;
		$asString .= $this->getPostmensReport($this->juniors);
		$asString .= PHP_EOL . 'Seniors:' . PHP_EOL;
		$asString .= $this->getPostmensReport($this->seniors);
		return $asString;
	}
	
	private function sortByDelivered(array &$array)
	{
		usort($array, function ($first, $second){
			$a = $first->getDelivered();
			$b = $second->getDelivered();
			
			if ($a == $b) {
				return 0;
			}
			return ($a < $b) ? -1 : 1;
		});
	}
	
	private function getPostmensReport(array $array)
	{
		$string = '';
		foreach ($array as $value){
			$string .= $value->getReport() . PHP_EOL;
		}
		return $string;
	}
}