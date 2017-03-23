<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 23/03/2017
 * Time: 08:10
 */

namespace ReservationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReservationBundle\GlobalEvents;
use ReservationBundle\Entity\Package;
use Symfony\Component\HttpFoundation\Request;

class PackageController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $package = $em->getRepository('ReservationBundle:Package')->findAll();
        return $this->render('@ReservationBundle/Resources/views/package/index.html.twig', array(
            'package' => $package,
        ));
    }


    public function newAction(Request $request)
    {
        $package = new Package();
        $form = $this->createForm('ReservationBundle\Form\PackageType', $package, array(
            'data_class' => 'ReservationBundle\Entity\Package'));
        if($request->getMethod()=== "POST") {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $packageEvent = $this->get('app.event.package');
                $packageEvent -> setPackage($package);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher-> dispatch(GlobalEvents::PACKAGE_ADD, $packageEvent);
                return $this->redirectToRoute('package_show', array('id' => $packageEvent->getPackage()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/package/new.html.twig', array(
            'package' => $package,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Package $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        return $this->render('@ReservationBundle/Resources/views/package/show.html.twig', array(
            'package' => $package,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Package $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        $editForm = $this->createForm('ReservationBundle\Form\PackageType', $package, array(
            'method' => "PUT"));
        if($request->getMethod()=== "PUT") {
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $packageEvent = $this->get('app.event.package');
                $packageEvent->setPackage($package);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher->dispatch(GlobalEvents::PACKAGE_EDIT, $packageEvent);

                return $this->redirectToRoute('package_show', array('id' => $packageEvent->getPackage()->getId()));
            }
        }
        return $this->render('@ReservationBundle/Resources/views/package/edit.html.twig', array(
            'package' => $package,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Package $package)
    {
        $form = $this->createDeleteForm($package);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $packageEvent = $this->get('app.event.package');
            $packageEvent->setPackage($package);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(GlobalEvents::PACKAGE_DELETE, $packageEvent);

        }
        return $this->redirectToRoute('package_index');
    }



    private function createDeleteForm(Package $package)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('package_delete', array('id' => $package->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}