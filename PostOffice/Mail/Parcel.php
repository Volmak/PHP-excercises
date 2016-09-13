<?php

namespace Mail;
use People\Citizen;

class Parcel extends AbstractMail
{
	const OVERSIZE = 60;
	const PRICE = 2;
	const OVERSIZED_FACTOR = 1.5;
	const FRAGILE_FACTOR = 1.5;
	
	protected $size = [];
	protected $isFragile;
	protected $price;
	
	public function __construct(Citizen $sender, Citizen $receiver, float $width, float $height, float $length, bool $isFragile)
	{
		parent::__construct($sender, $receiver);
		
		$this->size['x'] = $width;
		$this->size['y'] = $height;
		$this->size['z'] = $length;
		$this->isFragile = $isFragile;
		
		$this->price = $this->isFragile ? self::PRICE * self::FRAGILE_FACTOR : self::PRICE;
		$this->isOversized() ? $this->price *= self::OVERSIZED_FACTOR : false;
	}
	
	protected function isOversized()
	{
		foreach ($this->size as $size){
			if ($size > self::OVERSIZE) {
				return true;
			}			
		}
		return false;
	}
	
	public function getPrice()
	{
		return $this->price;
	}
	
	public function getIsFragile()
	{
		return $this->isFragile;
	}
}