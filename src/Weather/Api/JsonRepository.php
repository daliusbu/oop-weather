<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 19.5.1
 * Time: 12.47
 */

namespace Weather\Api;


use Weather\Model\JsonWeather;
use Weather\Model\NullJasonWeather;

class JsonRepository
{

    /**
     * @param \DateTime $date
     */
    public function selectByDate(\DateTime $date)
    {
        $items = $this->selectAll();
        $result = new NullJasonWeather();

        foreach ($items as $item) {
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;
            }
        }
        return $result;
    }


    public function selectByRange(\DateTime $from, \DateTime $to): array
    {
        $items = $this->selectAll();
        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @return JsonWeather[]
     */
    private function selectAll(): array
    {
        $result = [];
        $data = json_decode(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Weather.json'),
            true
        );
        foreach ($data as $item) {
            $record = new JsonWeather();
            $record->setDate(new \DateTime($item['date']));
            $record->setDayTemp($item['high']);
            $record->setNightTemp($item['low']);
            $record->setJsonSky($item['text']);
            $record->setDayOfWeek($item['day']);
            $result[] = $record;
        }

        return $result;
    }
}