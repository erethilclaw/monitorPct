<?php

namespace PctmonBundle\Controller;

use PctmonBundle\Form\SiteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PctmonBundle\Entity\Destinatari;
use PctmonBundle\Entity\Site;
use Doctrine\Common\Collections\ArrayCollection;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('PctmonBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        $sites = $this->getDoctrine()->getRepository('PctmonBundle:Site')->findAll();
//        foreach ($sites as $site){
//            dump($site->getIp($site->getUrl()));
//            die();
//        }
//        dump($sites);die();
        return $this->render('PctmonBundle:Site:list.html.twig', array(
            'sites' => $sites
        ));
    }

    public function addSiteAction(Request $request)
    {
        $site = new Site();
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

            return $this->redirectToRoute('site_index');
        }

        return $this->render('@Pctmon/Site/new_site.html.twig', array(
            'site' => $site,
            'form' => $form->createView(),
        ));
    }

    private function createDeleteForm(Site $site)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('site_delete', array('id' => $site->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function showAction(Site $site)
    {
        $deleteForm = $this->createDeleteForm($site);

        return $this->render('@Pctmon/Site/show_site.html.twig', array(
            'site' => $site,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Site $site)
    {
        $deleteForm = $this->createDeleteForm($site);
        $editForm = $this->createForm(SiteType::class, $site);

        $editForm->handleRequest($request);

        if ( $editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->persist($site);

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('site_show', array('id' => $site->getId()));
        }
        return $this->render('@Pctmon/Site/edit_site.html.twig', array(
            'site' => $site,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public
    function deleteAction(Request $request, Site $site)
    {
        $form = $this->createDeleteForm($site);
        $form->handleRequest($request);

     //   if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($site);
            $em->flush();
       // }
        return $this->redirectToRoute('site_index');
    }
}
