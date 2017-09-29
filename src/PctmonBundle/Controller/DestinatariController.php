<?php

namespace PctmonBundle\Controller;

use PctmonBundle\PctmonBundle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use PctmonBundle\Entity\Destinatari;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DestinatariController extends Controller{
  
    public function llistaAction()
    {
        $destinataris = $this->getDoctrine()->getRepository('PctmonBundle:Destinatari')->findAll();

        return $this->render('PctmonBundle:Destinatari:llista.html.twig',array(
            'destinataris' => $destinataris
        ));
    }

    public function addAction(Request $request)
    {
        $destinatari = new Destinatari();
        $form = $this->createForm('PctmonBundle\Form\DestinatariCrudType' , $destinatari);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($destinatari);
            $em->flush();

            return $this->redirectToRoute('destinatari_show', array('id' => $destinatari->getId()));
        }

        return $this->render('@Pctmon/Destinatari/new_destinatari.html.twig', array(
            'personalDatum' => $destinatari,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Destinatari $destinatari)
    {
        $deleteForm = $this->createDeleteForm($destinatari);

        return $this->render('@Pctmon/Destinatari/show_destinatari.html.twig', array(
            'destinatari' => $destinatari,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Destinatari $destinatari)
    {
        $deleteForm = $this->createDeleteForm($destinatari);
        $editForm = $this->createForm( 'PctmonBundle\Form\DestinatariCrudType',$destinatari);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->persist($destinatari);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('destinatari_show', array('id' => $destinatari->getId()));
        }

        return $this->render('@Pctmon/Destinatari/edit_destinatari.html.twig', array(
            'destinatari' => $destinatari,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Destinatari $destinatari)
    {
        $form = $this->createDeleteForm($destinatari);
        $form->handleRequest($request);

        if (!$destinatari){
            throw $this->createNotFoundException("Destinatari no trobat");
        }
      //  if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($destinatari);
            $em->flush();
        //}

        return $this->redirectToRoute('destinatari_index');
    }

    private function createDeleteForm(Destinatari $destinatari)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('destinatari_delete', array('id' => $destinatari->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
