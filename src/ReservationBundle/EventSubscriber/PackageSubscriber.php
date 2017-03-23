<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 08:19
 */

namespace ReservationBundle\EventSubscriber;

use ReservationBundle\GlobalEvents;
use Doctrine\ORM\EntityManager;
use ReservationBundle\Event\PackageEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PackageSubscriber implements EventSubscriberInterface
{
    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            GlobalEvents::PACKAGE_ADD => array('packageAdd', 250),
            GlobalEvents::PACKAGE_EDIT =>array('packageAdd', 250),
            GlobalEvents::PACKAGE_DELETE =>array('packageDelete', 250)
        );
    }

    public function packageAdd (PackageEvent $event) {
        $this->em->persist($event->getPackage());
        $this->em->flush();
    }

    public function packageDelete( PackageEvent $event) {
        $this->em->remove($event->getPackage());
        $this->em->flush($event->getPackage());
    }


}