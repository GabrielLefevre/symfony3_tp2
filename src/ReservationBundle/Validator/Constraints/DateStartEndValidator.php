<?php

/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 14:32
 */
namespace ReservationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use ReservationBundle\Entity\Period;

/**
 * @Annotation
 */
class DateStartEndValidator extends ConstraintValidator
{
    public function validate($protocol, Constraint $constraint) {
        if( $protocol->getEnd() < $protocol->getStart()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}