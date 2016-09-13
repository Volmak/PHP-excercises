<?php

class MajorCity extends City
{
	protected $regionPopulation;
	
	public function __construct($name, $countryCode, $developmentIndex, $climateInfo, int $regionPopulation)
	{
		parent::__construct($name, $countryCode, $developmentIndex, $climateInfo);
		
		$this->regionPopulation = $regionPopulation;
	}
	
	public function __set($field, $value)
	{
		parent::__set($field, $value);
		
		if (($field == 'population' || $field == "regionPopulation") && $value == intval($value));
	}
	
	public function __toString()
	{
		return "$this->name, $this->countryCode" . PHP_EOL .
		"Development index: $this->developmentIndex" . PHP_EOL .
		"Region's population: $this->regionPopulation" . PHP_EOL .
		$this->climateInfo;
	}
}
