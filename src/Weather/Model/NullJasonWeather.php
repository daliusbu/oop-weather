<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 19.5.1
 * Time: 14.47
 */

namespace Weather\Model;


class NullJasonWeather extends JsonWeather
{
    public function __construct()
    {
        $this->setDayTemp(5);
        $this->setNightTemp(-1);
        $this->setDate(new \DateTime('1970-01-01'));
        $this->setJsonSky('Sunny');
        $this->setDayOfWeek('Mon');
    }

}

