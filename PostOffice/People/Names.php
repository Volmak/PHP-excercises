<?php

namespace People;

class Names
{
	public static $arrayOfFirstNames = ['Иван', 'Петкан', 'Георги', 'Петър', 'Пламен', 'Атанас', 'Павел', 'Исмаил', 'Кирил', 'Методи', 'Симеон', 'Борис', 'Асен', 'Явор', 'Ясен', 'Крум', 'Кубрат', 'Аспарух','Александър', 'Томи', 'Генади', 'Дончо', 'Добри', 'Тервел', 'Христо', 'Васил', 'Стефан', 'Йордан'];
	public static $arrayOfLastNames = ['Стефанов', 'Павлов', 'Иванов', 'Петров', 'Петков', 'Данов', 'Мераклиев', 'Дюлгеров', 'Славщенски', 'Стамболов', 'Кунев', 'Пулев', 'Вазов', 'Добромиров', 'Шипков', 'Владигеров', 'Пънчев', 'Храсталов', 'Бикоборов', 'Ботев', 'Малинов', 'Капинов', 'Мамарчев', 'Александров', 'Башелиев', 'Желязков', 'Банчев', 'Георгиев', 'Йорданов', 'Василев', 'Йовков', 'Михайлов', 'Борисов'];

	public static function getRandomFirstName()
	{
		return static::$arrayOfFirstNames[array_rand(static::$arrayOfFirstNames)];
	}

	public static function getRandomLastName()
	{
		return static::$arrayOfLastNames[array_rand(static::$arrayOfLastNames)];
	}

	public static function getRandomFullName()
	{
		return static::$arrayOfFirstNames[array_rand(static::$arrayOfFirstNames)] . ' ' . 
		static::$arrayOfLastNames[array_rand(static::$arrayOfLastNames)];
	}	
}