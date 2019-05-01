<?php

namespace Weather\Controller;

use Weather\Manager;
use Weather\Model\NullWeather;

class StartPage
{
    public function getTodayWeather(?string $src ): array
    {
        try {
            $service = new Manager();
            $weather = $service->getTodayInfo($src);
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return ['template' => 'today-weather.twig', 'context' => ['weather' => $weather]];
    }

    public function getWeekWeather(?string $src): array
    {
        try {
            $service = new Manager();
            $weathers = $service->getWeekInfo($src);

        } catch (\Exception $exp) {
            $weathers = [];
        }

        return ['template' => 'range-weather.twig', 'context' => ['weathers' => $weathers]];
    }
}