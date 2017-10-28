<?php

namespace PremierBundle\Controller;

use PremierBundle\Entity\Achat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;


class AchatController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $achats = $em->getRepository('PremierBundle:Achat')->findAll();

        return $this->render('@Premier/achat/index.html.twig', array(
            'achats' => $achats,
        ));
    }




    public function showAction(Achat $achat)
    {


        return $this->render('@Premier/achat/show.html.twig', array(
            'achat' => $achat
        ));
    }



}
