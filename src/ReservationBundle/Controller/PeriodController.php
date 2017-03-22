<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 11:03
 */

namespace ReservationBundle\Controller;

use ReservationBundle\Entity\Period;
use ReservationBundle\GlobalEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PeriodController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $period = $em->getRepository('ReservationBundle:Period')->findAll();
        return $this->render('@ReservationBundle/Resources/views/period/index.html.twig', array(
            'period' => $period,
        ));
    }


    public function newAction(Request $request)
    {
        $period = new Period();
        $form = $this->createForm('ReservationBundle\Form\PeriodType', $period, array(
            'data_class' => 'ReservationBundle\Entity\Period'));
        if($request->getMethod()=== "POST") {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $periodEvent = $this->get('app.event.period');
                $periodEvent -> setPeriod($period);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher-> dispatch(GlobalEvents::PERIOD_ADD, $periodEvent);
                return $this->redirectToRoute('period_show', array('id' => $periodEvent->getPeriod()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/period/new.html.twig', array(
            'period' => $period,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Period $period)
    {
        $deleteForm = $this->createDeleteForm($period);
        return $this->render('@ReservationBundle/Resources/views/period/show.html.twig', array(
            'period' => $period,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Period $period)
    {

        $deleteForm = $this->createDeleteForm($period);
        $editForm = $this->createForm('ReservationBundle\Form\PeriodType', $period, array(
            'method' => "PUT"));
        if($request->getMethod()=== "PUT") {
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $periodEvent = $this->get('app.event.period');
                $periodEvent->setPeriod($period);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher->dispatch(GlobalEvents::PERIOD_EDIT, $periodEvent);

                return $this->redirectToRoute('period_show', array('id' => $periodEvent->getPeriod()->getId()));
            }
        }

        return $this->render('period/edit.html.twig', array(
            'period' => $period,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    private function createDeleteForm(Period $period)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('period_delete', array('id' => $period->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }



}