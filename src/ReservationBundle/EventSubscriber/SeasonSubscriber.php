<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 16:08
 */

namespace ReservationBundle\EventSubscriber;


use ReservationBundle\Entity\Season;
use ReservationBundle\GlobalEvents;
use Doctrine\ORM\EntityManager;
use ReservationBundle\Event\SeasonEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SeasonSubscriber implements EventSubscriberInterface
{
    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            GlobalEvents::SEASON_ADD => array('seasonAdd', 250),
            GlobalEvents::SEASON_EDIT =>array('seasonAdd', 250),
            GlobalEvents::SEASON_DELETE =>array('seasonDelete', 250)
        );
    }

    public function seasonAdd (SeasonEvent $event) {
        $this->em->persist($event->getSeason());
        $this->em->flush();
    }

    public function seasonDelete( SeasonEvent $event) {
        $this->em->remove($event->getSeason());
        $this->em->flush($event->getSeason());
    }

}