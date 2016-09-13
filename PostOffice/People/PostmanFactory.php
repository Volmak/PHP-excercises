<?php

namespace People;

class PostmanFactory
{
	const REQUIRED_EXPERIANCE = 3;
	const RETIREMENT_EXPERIANCE = 40;

	public static function createRandomPostman(float $experience = -1)
	{
		if ($experience < 0){ $experience = rand(0, self::RETIREMENT_EXPERIANCE);}
		return self::createPostman(Names::getRandomFirstName(), Names::getRandomLastName(), $experience);
	}

	public static function createRandomJuniorPostman()
	{
		$experience = rand(0, self::REQUIRED_EXPERIANCE -1);
		return self::createPostman(Names::getRandomFirstName(), Names::getRandomLastName(), $experience);
	}

	public static function createRandomSeniorPostman()
	{
		$experience = rand(self::REQUIRED_EXPERIANCE, self::RETIREMENT_EXPERIANCE);
		return self::createPostman(Names::getRandomFirstName(), Names::getRandomLastName(), $experience);
	}
	
	public static function createPostman(string $firstName,string $lastName,float $experience)
	{
		if ($experience >= static::REQUIRED_EXPERIANCE){
			return new SeniorPostman($firstName, $lastName, $experience);
		} else {
			return new JuniorPostman($firstName, $lastName, $experience);
		}
	}
}