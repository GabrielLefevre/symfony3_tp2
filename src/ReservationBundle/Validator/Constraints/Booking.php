<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 29/03/2017
 * Time: 15:56
 */

namespace ReservationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Booking extends Constraint
{
    public $message = 'Cette période est déjà réservé.';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}