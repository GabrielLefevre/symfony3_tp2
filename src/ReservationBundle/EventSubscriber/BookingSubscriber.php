<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 09:49
 */

namespace ReservationBundle\EventSubscriber;


use ReservationBundle\GlobalEvents;
use Doctrine\ORM\EntityManager;
use ReservationBundle\Event\BookingEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookingSubscriber implements EventSubscriberInterface
{
    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            GlobalEvents::BOOKING_ADD => array(
                array('calculPrice', 10),
                array('bookingAdd', 9)
            ),
            GlobalEvents::BOOKING_EDIT =>array('bookingAdd', 250),
            GlobalEvents::BOOKING_DELETE =>array('bookingDelete', 250)
        );
    }

    public function calculPrice(BookingEvent $event) {
        die("calcul");
    }


    public function bookingAdd (BookingEvent $event) {
       die ("add");
        // $this->em->persist($event->getBooking());
        //$this->em->flush();
    }

    public function bookingDelete( BookingEvent $event) {
        $this->em->remove($event->getBooking());
        $this->em->flush($event->getBooking());
    }
}