<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 08:18
 */

namespace ReservationBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class PackageEvent extends Event
{
    private $package;

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param mixed $pakage
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }



}