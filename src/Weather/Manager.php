<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbRepository;
use Weather\Api\GoogleApi;
use Weather\Api\JsonRepository;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;
    private $src;


    public function getTodayInfo($src) //: Weather
    {
        $this->src = $src;
        switch ($src){
            case 'google':
                return (new GoogleApi())->getToday();
                break;
            case 'json':
                return $this->getTransporter($src)->selectByDate(new \DateTime());
                break;
            default:
                return $this->getTransporter($src)->selectByDate(new \DateTime());
        }
    }

    public function getWeekInfo($src): array
    {
        switch ($src){
            case 'google':
                $gWeek = [];
                for ($i = 0; $i<7; $i++){
                    $oneDay = (new GoogleApi())->getToday();
                    $oneDay->setDate(new \DateTime("+ $i days"));
                    $gWeek[] = $oneDay;
                }
                return $gWeek;
            case 'json':
                return $this->getTransporter($src)->selectByRange(new \DateTime('midnight'), new \DateTime('+6 days midnight'));
            default:
                return $this->getTransporter($src)->selectByRange(new \DateTime('midnight'), new \DateTime('+6 days midnight'));
        }
    }

    private function getTransporter(?string $src)
    {
        if (null === $this->transporter) {
            if ($src === 'json'){
                $this->transporter = new JsonRepository();
            } else{
                $this->transporter = new DbRepository();
            }
        }

        return $this->transporter;
    }
}


