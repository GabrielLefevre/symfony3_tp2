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

class PeriodValidator extends ConstraintValidator
{
    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }


    public function validate($value, Constraint $constraint)
    {
        $allPeriod = $this->em->getRepository('ReservationBundle:Period')->findAll();
        for( $i=0; $i<count($allPeriod);$i++) {
            if ($value->getStart() >= $allPeriod[$i]->getStart() && $value->getStart() <= $allPeriod[$i]->getEnd() || $value->getEnd() >= $allPeriod[$i]->getStart() && $value->getEnd() <= $allPeriod[$i]->getEnd() || $allPeriod[$i]->getStart() >= $value->getStart() && $allPeriod[$i]->getStart() <= $value->getEnd() || $allPeriod[$i]->getEnd() >= $value->getStart() && $allPeriod[$i]->getEnd()<= $value->getEnd()) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            } // if
        } // for
    } // validate


}