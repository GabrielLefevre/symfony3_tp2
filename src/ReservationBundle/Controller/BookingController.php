<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 09:39
 */

namespace ReservationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReservationBundle\GlobalEvents;
use ReservationBundle\Entity\Booking;
use ReservationBundle\Entity\Summation;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller
{

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('ReservationBundle:Booking')->findAll();
        return $this->render('@ReservationBundle/Resources/views/booking/index.html.twig', array(
            'booking' => $booking,
        ));
    }


    public function newAction(Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm('ReservationBundle\Form\BookingType', $booking, array(
            'data_class' => 'ReservationBundle\Entity\Booking'));
        if($request->getMethod()=== "POST") {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $bookingEvent = $this->get('app.event.booking');
                $bookingEvent -> setBooking($booking);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher-> dispatch(GlobalEvents::BOOKING_ADD, $bookingEvent);
                return $this->redirectToRoute('booking_show', array('id' => $bookingEvent->getBooking()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/booking/new.html.twig', array(
            'booking' => $booking,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Booking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);
        return $this->render('@ReservationBundle/Resources/views/booking/show.html.twig', array(
            'booking' => $booking,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Booking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);
        $editForm = $this->createForm('ReservationBundle\Form\BookingType', $booking, array(
            'method' => "PUT"));
        if($request->getMethod()=== "PUT") {
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $bookingEvent = $this->get('app.event.booking');
                $bookingEvent->setBooking($booking);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher->dispatch(GlobalEvents::BOOKING_EDIT, $bookingEvent);

                return $this->redirectToRoute('booking_show', array('id' => $bookingEvent->getBooking()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/booking/edit.html.twig', array(
            'booking' => $booking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Booking $booking)
    {
        $form = $this->createDeleteForm($booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bookingEvent = $this->get('app.event.booking');
            $bookingEvent->setBooking($booking);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(GlobalEvents::BOOKING_DELETE, $bookingEvent);

        }
        return $this->redirectToRoute('booking_index');
    }



    private function createDeleteForm(Booking $booking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('booking_delete', array('id' => $booking->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}