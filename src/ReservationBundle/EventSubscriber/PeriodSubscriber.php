<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 11:12
 */

namespace ReservationBundle\EventSubscriber;

use ReservationBundle\Entity\Period;
use ReservationBundle\GlobalEvents;
use Doctrine\ORM\EntityManager;
use ReservationBundle\Event\PeriodEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PeriodSubscriber implements EventSubscriberInterface
{
    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            GlobalEvents::PERIOD_ADD => array('periodAdd', 250)
        );
    }

    public function periodAdd (PeriodEvent $event) {
        $this->em->persist($event->getPeriod());
        $this->em->flush();
    }

}