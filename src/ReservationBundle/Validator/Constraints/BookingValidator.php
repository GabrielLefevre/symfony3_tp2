<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 29/03/2017
 * Time: 15:56
 */

namespace ReservationBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use ReservationBundle\Entity\Booking;

class BookingValidator extends ConstraintValidator
{
    private $em;
    private $booking;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($currentBooking, Constraint $constraint) {
        $allBooking = $this->em->getRepository('ReservationBundle:Booking')->findAll();

        if($this->validDate($allBooking, $currentBooking) === false) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%debut%', $this->booking)
                ->addViolation();
        }
    }

    public function validDate(array $allBooking, Booking $currentBooking) {
        foreach( $allBooking as $booking ) {
            $this->booking = $booking;
            if($this->dateInBooking($currentBooking->getStart(), $booking ) === false ||
                $this->dateInBooking($currentBooking->getEnd(), $booking ) === false ) {
                return false;
            }
            if($this->bookingStartInDate($booking, $currentBooking ) === false &&
                $this->bookingEndInDate($booking, $currentBooking) === false ) {
                return false;
            }
        } // for
        return true;
    }

    private function dateInBooking(\DateTime $date, Booking $booking ) {
        if ($date >= $booking->getStart() && $date <= $booking->getEnd()) {
            return false;
        }
        return true;
    }

    private function bookingStartInDate(Booking $booking, Booking $currentBooking ) {
        if ($currentBooking->getStart() <= $booking->getStart() && $currentBooking->getStart() <= $booking->getEnd()) {
            return false;
        }
        return true;
    }

    private function bookingEndInDate(Booking $booking, Booking $currentBooking ) {
        if ($currentBooking->getEnd() >= $booking->getStart() && $currentBooking->getEnd() >= $booking->getEnd()) {
            return false;
        }
        return true;
    }


}