<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 16:22
 */

namespace ReservationBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use ReservationBundle\Entity\Period;

class PeriodValidator extends ConstraintValidator
{
    private $em;
    private $period;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }


    public function validate($currentPeriod, Constraint $constraint)
    {

        $allPeriod = $this->em->getRepository('ReservationBundle:Period')->findAll();

       if($this->validDate($allPeriod, $currentPeriod) === false) {
           $this->context->buildViolation($constraint->message)
               ->setParameter('%debut%', $this->period)
               ->addViolation();
       }

    } // validate

    public function validDate(array $allPeriod, Period $currentPeriod) {
        foreach( $allPeriod as $period ) {
            $this->period = $period;
          if($this->dateInPeriod($currentPeriod->getStart(), $period ) ||
              $this->dateInPeriod($currentPeriod->getEnd(), $period ) ) {
              return false;
          }
            if($this->dateInPeriod($period, $currentPeriod->getStart() ) ||
                $this->dateInPeriod($period, $currentPeriod->getEnd()) ) {
                return false;
            }
        } // for
        return true;
    }

    private function dateInPeriod(\DateTime $date, Period $period ) {
        if ($date >= $period->getStart() && $date <= $period->getEnd()) {
            return false;
        }
        return true;
    }


}

/*
 *  $currentPeriod->getStart() >= $allPeriod[$i]->getStart() && $currentPeriod->getStart() <= $allPeriod[$i]->getEnd()
 *  $currentPeriod->getEnd() >= $allPeriod[$i]->getStart() && $currentPeriod->getEnd() <= $allPeriod[$i]->getEnd()
 *  $allPeriod[$i]->getStart() >= $currentPeriod->getStart() && $allPeriod[$i]->getStart() <= $currentPeriod->getEnd()
 * $allPeriod[$i]->getEnd() >= $currentPeriod->getStart() && $allPeriod[$i]->getEnd()<= $currentPeriod->getEnd()
 */