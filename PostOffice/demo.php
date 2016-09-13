<?php

use People\Citizen;
use People\Adresses;
use Mail\Letter;
use Mail\Parcel;
use People\Names;
use Post\PostStation;

require_once 'autoload.php';
require_once 'readline.php';

const CHANCE_FOR_A_PARCEL = 4; // 1 to 4 aka 20%
const FRAGILE_CHANCE = 5;
const MAXIMUM_NUMBER_OF_MAILS_PER_CITIZEN = 3;
const POPULATION = 100;

$post = PostStation::getInstance();

$citizens = [];
for ($i = 0; $i < POPULATION; $i++) {
	$citizens[] = new Citizen(Names::getRandomFirstName(), Names::getRandomLastName(), Adresses::getRandomAdress());
}

function getRandomCitizen () {
	return $GLOBALS['citizens'][array_rand($GLOBALS['citizens'])];
}

function randomSize() {
	return rand(5,70);
}

function isFragile() {
	$rand = rand(0,FRAGILE_CHANCE);
	if ($rand == 0){
		return true;
	}
	return false;
}

echo 'You may experiance some delays. They are all intentional. Dont worry :)' . PHP_EOL;

foreach ($citizens as $citizen) {
	for ($i = rand(1,MAXIMUM_NUMBER_OF_MAILS_PER_CITIZEN); $i <= MAXIMUM_NUMBER_OF_MAILS_PER_CITIZEN; $i++){
		$mails = [];
		if(rand(0,CHANCE_FOR_A_PARCEL)){
			$mails[] = new Letter($citizen, getRandomCitizen());
		} else {
			$mails[] = new Parcel($citizen, getRandomCitizen(), randomSize(), randomSize(), randomSize(), isFragile());
		}
		$citizen->receiveMail($mails);
	}
	$citizen->sendMailAtRandom($post);
}

foreach ($post->getPostBoxes() as $n => $box)
{
	if ($box->isFull()){
		echo "Postbox No. $n contains " . $box->getMailsInfo() . PHP_EOL;
	}
}
echo 'The poststation has ' . $post->getMailsInfo() . PHP_EOL . PHP_EOL . PHP_EOL;

$post->chooseAction();

foreach ($post->getPostBoxes() as $n => $box)
{
	if ($box->isFull()){
		echo "Postbox No. $n contains " . $box->getMailsInfo() . PHP_EOL;
	}
}
echo 'The poststation has ' . $post->getMailsInfo() . PHP_EOL . PHP_EOL . PHP_EOL;

$post->chooseAction();

foreach ($citizens as $receiver)
{
	if ($receiver->isFull()){
		echo $receiver->getFullName() . ' has ' . 
		$receiver->getMailsInfo() . PHP_EOL;
	}
}
echo 'The poststation has ' . $post->getMailsInfo() . PHP_EOL . PHP_EOL . PHP_EOL;

readline('Press Еnter to get list of all mails for today.');

$post->printArchiveFromDate(date('Y-m-d'));

readline('Press Enter to get more info on the mails');

echo 'On ' . date('Y-m-d') . ':' . PHP_EOL;
echo round($post->getLettersPercentFromDate(date('Y-m-d')),2) . '% of all mails were letters.' . PHP_EOL;
echo round($post->getFragilePercentFromDate(date('Y-m-d')), 2) . '% of all parcels were fragile' . PHP_EOL;

readline('Press Enter to get report on the postmens work.');

echo $post->getPostmensDelivered();