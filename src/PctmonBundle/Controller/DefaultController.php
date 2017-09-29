<?php

namespace PctmonBundle\Controller;

use PctmonBundle\Form\SiteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PctmonBundle\Entity\Destinatari;
use PctmonBundle\Entity\Site;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PctmonBundle:Default:index.html.twig');
    }
}
