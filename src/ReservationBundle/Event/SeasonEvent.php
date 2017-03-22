<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 16:07
 */

namespace ReservationBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class SeasonEvent extends Event
{
    private $season;

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }




}