<?php

require_once 'autoload.php';

$page1 = new Page('Title page', 'Lord of the rings' . PHP_EOL . 'by J.R.R.Tolkin');
echo $page1->read() . PHP_EOL;
$page2 = new Page('Thanks', 'Special thanks to my friends');
$page2->deleteText(-10);
$page2->addText('Ivan Stefanov');
echo $page2->read() . PHP_EOL . PHP_EOL;

$book = new SimpleNotepad([$page1, $page2]);
$book->addPage(new Page('Story', 'A story of an adventure'));
echo $book->readAll() . PHP_EOL;

// $kaboom = new AbstractNotepad;

try {
$securedKaboom = new SecuredNotepad('alabalanica', [$page1,$page2]);
} catch (Exception $e) {
	echo $e->getMessage() . PHP_EOL;
}

$secured = new SecuredNotepad('RtTf-0p71mu5', [$page1,$page2]);
echo $secured->readAll() . PHP_EOL; //just a new line here
$_GET['password'] = 'RtTf-0p71mu5';
$secured->setTextOnPage(1, 'Special thanks to Vasil Atanasov');
echo $secured->readAll() . PHP_EOL;

echo 'Index of \'rings\': ' . $page1->searchWord('rings') . PHP_EOL;
echo 'Contains digits: ' . $page1->containsDigits() . PHP_EOL . PHP_EOL;

echo $book->searchWord('thanks') . PHP_EOL;

$book->setTextOnPage(2, 'Chapter 1:' . PHP_EOL . 'The story begins in the Shire...');
$book->printAllPagesWithDigits();

$itDoesTheSameStuff = new ElectronicSecuredNotepad('RtTf-0p71mu5', $book->getPages());
echo $itDoesTheSameStuff->readAll() . PHP_EOL;
$itDoesTheSameStuff->start();
echo $itDoesTheSameStuff->readAll() . PHP_EOL;

echo 'Можеше всички методи на SecuredNotepad и ElectronicSecuredNotepad да се достъпват през магическия метод __call ' . 
'Така щях да си спестя проверките за вярна парола и пуснато устройство във всеки метод и нямаше да имам повтарящ се код'
		. ' Още едно закъсняло прозрение...';