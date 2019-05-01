<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 19.5.1
 * Time: 12.54
 */

namespace Weather\Model;


class JsonWeather extends Weather
{

    private $jsonMap = [
        'Cloudy' => 'cloud',
        'Scattered Showers' => 'cloud-rain',
        'Sunny' => 'sun',
        "Breezy" => 'wind',
        "Partly Cloudy" => 'cloud-sun',
        "Mostly Cloudy" => "cloud-sun"
    ];

    /**
     * @var string
     */
    protected $dayOfWeek;

    /**
     * @var string
     */
    protected $jsonSky;

    /**
     * @return string
     */
    public function getDayOfWeek(): string
    {
        return $this->dayOfWeek;
    }

    /**
     * @param string $dayOfWeek
     */
    public function setDayOfWeek(string $dayOfWeek): void
    {
        $this->dayOfWeek = $dayOfWeek;
    }

    /**
     * @return string
     */
    public function getJsonSky(): string
    {
        return $this->jsonSky;
    }

    /**
     * @param string $jsonSky
     */
    public function setJsonSky(string $jsonSky): void
    {
        $this->jsonSky = $jsonSky;
    }


    public function getSkySymbol()
    {
        return $this->jsonMap[$this->jsonSky];
    }


}