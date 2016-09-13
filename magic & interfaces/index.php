<?php

require_once 'autoload.php';

$sliven = new MajorCity('Sliven', 'BGR', 0.79, new ClimateInfo(0, 1000), 80000);
$koprivshtitza = new City('Koprivshtitza', 'BGR', 0.7, new ClimateInfo(-20, 40));
$bulgari = new City('Bulgari', 'ITL', 0.88, new ClimateInfo(-24.5, 55));

$guideToEverywhereAndBeyond = new TouristsGuide(3);
$guideToEverywhereAndBeyond->addCity($sliven);
$guideToEverywhereAndBeyond->addCity($koprivshtitza);
$guideToEverywhereAndBeyond->addCity($bulgari);

echo $guideToEverywhereAndBeyond->getClimateInfo();

$luciferTours = new HotMegapolisAdvisor();

echo $guideToEverywhereAndBeyond->getBest($luciferTours);

/*създайте TourstsGuide с три града, един от
 които е областен.
 Създайте инстанция на HotMegapolisAdvisor и с нея демонстрирайте
 използването на всички дефинирани нестатични методи на
 TouristsGuide*/