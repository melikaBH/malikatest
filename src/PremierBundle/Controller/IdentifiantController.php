<?php

namespace PremierBundle\Controller;

use PremierBundle\Entity\Identifiant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;


class IdentifiantController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $identifiants = $em->getRepository('PremierBundle:Identifiant')->findAll();

        return $this->render('PremierBundle:identifiant:index.html.twig', array(
            'identifiants' => $identifiants,
        ));
    }


    public function newAction(Request $request)
    {
        $identifiant = new Identifiant();
        $form = $this->createForm('PremierBundle\Form\IdentifiantType', $identifiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($identifiant);
            $em->flush();

            return $this->redirectToRoute('list_identifiant');
        }

        return $this->render('@Premier/identifiant/new.html.twig', array(
            'identifiant' => $identifiant,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Identifiant $identifiant)
    {
        $deleteForm = $this->createDeleteForm($identifiant);

        return $this->render('identifiant/show.html.twig', array(
            'identifiant' => $identifiant,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Identifiant $identifiant)
    {
        $deleteForm = $this->createDeleteForm($identifiant);
        $editForm = $this->createForm('PremierBundle\Form\IdentifiantType', $identifiant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modify_identifiant', array('id' => $identifiant->getId()));
        }

        return $this->render('@Premier/identifiant/edit.html.twig', array(
            'identifiant' => $identifiant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Identifiant $identifiant)
    {
        $form = $this->createDeleteForm($identifiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($identifiant);
            $em->flush();
        }

        return $this->redirectToRoute('list_identifiant');
    }


    private function createDeleteForm(Identifiant $identifiant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_identifiant', array('id' => $identifiant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
