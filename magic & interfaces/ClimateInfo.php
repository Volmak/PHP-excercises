<?php

class ClimateInfo
{
	protected $minTemp;
	protected $maxTemp;
	
	public function __construct(float $minimalObservedTemperatureInC, float $maximalObservedTemperatureInC)
	{
		$this->minTemp = $minimalObservedTemperatureInC;
		$this->maxTemp = $maximalObservedTemperatureInC;
	}
	
	public function __get($what)
	{
		if (strpos($what, 'min') === 0){
			return $this->minTemp;
		}
		if (strpos($what, 'max') === 0){
			return $this->maxTemp;
		}
	}
	
	public function __toString()
	{
		return "Observed temeperatures in Celsius: " . PHP_EOL .
		"minimal " . $this->minTemp . PHP_EOL . 
		"maximal " . $this->maxTemp . PHP_EOL;
	}
}