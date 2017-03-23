<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 14:58
 */

namespace ReservationBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class DateStartEnd extends Constraint
{
    public $message = 'La date de fin doit être supérieur à la date de départ.';


    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}