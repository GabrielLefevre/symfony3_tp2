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
use ReservationBundle\Entity\Period;

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
                array('calculDateEnd', 11),
                array('calculPrice', 10),
                array('bookingAdd', 9)
            ),
            GlobalEvents::BOOKING_EDIT =>array('bookingAdd', 250),
            GlobalEvents::BOOKING_DELETE =>array('bookingDelete', 250)
        );
    }

    public function calculDateEnd(BookingEvent $event) {
        die("a");
        $nbUnit = $event->getBooking()->getPackage()->getNumberunit();
        die("b");
        $dateStart = $event->getBooking()->getDatestart();
        $dateEnd = new \DateTime($dateStart);
       // $dateEnd->modify('+'.$nbUnit.' day');
        die($dateStart." - ".$dateEnd);
        $event->setDateend($dateEnd);
    }


    public function calculPrice(BookingEvent $event) {
        $priceU = $event->getBooking()->getPackage()->getPrice();
        if($event->getBooking()->getPackage()->getPrice() == 0 ) {
            exit;
        }
        $priceFinal = 0;
        $nbUnit = $event->getBooking()->getPackage()->getNumberunit();
        $dateCurrent = $event->getBooking()->getDatestart();
        $allPeriod = $this->em->getRepository('ReservationBundle:Period')->findAll();

        for ($i=0; $i<$nbUnit;$i++) {
            foreach ($allPeriod as $period) {
                if($period->getStart()>=$dateCurrent && $dateCurrent<=$period->getEnd()) {
                    $priceFinal += $priceU*$period->getSeason()->getIncrease();
                }
            }// foreach
        }//for

        die($priceFinal);
        $event->setPricefinal($priceFinal);
    }


    public function bookingAdd (BookingEvent $event) {
       die ("add");
         $this->em->persist($event->getBooking());
        $this->em->flush();
    }

    public function bookingDelete( BookingEvent $event) {
        $this->em->remove($event->getBooking());
        $this->em->flush($event->getBooking());
    }

}

// $allPeriod = $this->em->getRepository('ReservationBundle:Period')->findAll();