<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 09:48
 */

namespace ReservationBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class BookingEvent extends Event
{
    private $booking;

    /**
     * @return mixed
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * @param mixed $booking
     */
    public function setBooking($booking)
    {
        $this->booking = $booking;
    }


}