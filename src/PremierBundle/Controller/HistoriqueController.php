<?php

namespace PremierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class HistoriqueController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('PremierBundle:Achat')->findAll();

        return $this->render('PremierBundle:Historique:index.html.twig',array(
            'entities' => $entities
        ));
    }

    public function HistoriqueFilter(){

    }

}
