<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 16:01
 */

namespace ReservationBundle\Controller;


use ReservationBundle\Entity\Season;
use ReservationBundle\GlobalEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SeasonController extends Controller
{

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $season = $em->getRepository('ReservationBundle:Season')->findAll();
        return $this->render('@ReservationBundle/Resources/views/season/index.html.twig', array(
            'season' => $season,
        ));
    }


    public function newAction(Request $request)
    {
        $season = new Season();
        $form = $this->createForm('ReservationBundle\Form\SeasonType', $season, array(
            'data_class' => 'ReservationBundle\Entity\Season'));
        if($request->getMethod()=== "POST") {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $seasonEvent = $this->get('app.event.season');
                $seasonEvent -> setSeason($season);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher-> dispatch(GlobalEvents::SEASON_ADD, $seasonEvent);
                return $this->redirectToRoute('season_show', array('id' => $seasonEvent->getSeason()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/season/new.html.twig', array(
            'season' => $season,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Season $season)
    {
        $deleteForm = $this->createDeleteForm($season);
        return $this->render('@ReservationBundle/Resources/views/season/show.html.twig', array(
            'season' => $season,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Season $season)
    {
        $deleteForm = $this->createDeleteForm($season);
        $editForm = $this->createForm('ReservationBundle\Form\SeasonType', $season, array(
            'method' => "PUT"));
        if($request->getMethod()=== "PUT") {
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $seasonEvent = $this->get('app.event.season');
                $seasonEvent->setSeason($season);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher->dispatch(GlobalEvents::SEASON_EDIT, $seasonEvent);

                return $this->redirectToRoute('season_show', array('id' => $seasonEvent->getSeason()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/season/edit.html.twig', array(
            'season' => $season,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Season $season)
    {
        $form = $this->createDeleteForm($season);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $seasonEvent = $this->get('app.event.season');
            $seasonEvent->setSeason($season);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(GlobalEvents::SEASON_DELETE, $seasonEvent);

        }
        return $this->redirectToRoute('season_index');
    }



    private function createDeleteForm(Season $season)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('season_delete', array('id' => $season->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }



}