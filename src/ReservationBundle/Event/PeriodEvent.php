<?php

/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 11:10
 */
namespace ReservationBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class PeriodEvent extends Event
{
    private $period;

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }


}