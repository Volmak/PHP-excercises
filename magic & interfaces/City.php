<?php

class City
{
	protected $name;
	protected $countryCode;
	protected $developmentIndex;
	protected $climateInfo;
	
	public function __construct(string $name,string $countryCode, float $developmentIndex, ClimateInfo $climateInfo)
	{
		if (!preg_match('/^[A-z]{3,}$/', $name) || !preg_match('/^[A-Z]{3}$/', $countryCode) || 
				$developmentIndex < 0 || $developmentIndex > 1){
			throw new Exception('Invalid input');
		}
		$this->name = $name;
		$this->countryCode = $countryCode;
		$this->developmentIndex = $developmentIndex;
		$this->climateInfo = $climateInfo;
	}
	
	public function __get($field)
	{
		return $this->$field;
	}
	
	public function __set($field, $value)
	{
		if ($field == 'name' && preg_match('/^[A-z]{3,}$/', $value)) {
			$this->name = $value;
		}
		if (($field == 'country' || $field == 'countryCode') && preg_match('/^[A-Z]{3}$/', $value)){
			$this->countryCode = $value;
		}
		if(($field == 'developmentIndex' || $field == 'di') && $value < 1 && $value > 0){
			$this->developmentIndex = $value;
		}
		if ($field == 'climateInfo' && $value instanceof ClimateInfo){
			$this->climateInfo = $value;
		}
	}
	
	public function __toString()
	{
		return "$this->name, $this->countryCode" . PHP_EOL .
		"Development index: " . $this->developmentIndex . PHP_EOL . 
		$this->climateInfo;
	}
}
