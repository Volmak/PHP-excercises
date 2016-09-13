<?php

class TouristsGuide
{
	protected $count;
	protected $cities;
	
	public function __construct($count)
	{
		$this->count = $count;
		$this->cities = [];
	}
	
	static function convertToFahrenheit($degrees)
	{
		return $degrees * 9 / 5 + 32;
	}
	
	public function addCity(City $city)
	{
		if (count($this->cities) > $this->count){
			return;
		}
		$this->cities[] = $city;
	}
	
	public function getClimateInfo($isFahrenheit = false)
	{
		$string = '';
		foreach ($this->cities as $city){
			$string .= PHP_EOL . $city->name . PHP_EOL;
			$string .= $isFahrenheit ? 'Temperatures in Fahrenheit: ' . 
			TouristsGuide::convertToFahrenheit($city->climateInfo->min) . ' - ' . 
			TouristsGuide::convertToFahrenheit($city->climateInfo->max) . PHP_EOL :
			'Temperatures in Celsious: ' . $city->climateInfo->min . ' - ' . $city->climateInfo->max . PHP_EOL;
		}
		return $string;
	}
	
	public function getBest(ITripAdvisor $advisor)
	{
		$rating = 0;
		$best;
		foreach ($this->cities as $city){
			if ($advisor->rate($city) > $rating) {
				$best = $city;
				$rating = $advisor->rate($city);
			}
		}
		return PHP_EOL . $best;
	}
}