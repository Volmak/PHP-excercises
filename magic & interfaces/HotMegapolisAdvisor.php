<?php

class HotMegapolisAdvisor implements ITripAdvisor
{
	public function rate(City $city)
	{
		return $city instanceof MajorCity ? $city->climateInfo->maxTemp * 1.5 : $city->climateInfo->maxTemp;
	}
}
