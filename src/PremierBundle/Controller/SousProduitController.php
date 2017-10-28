<?php

namespace PremierBundle\Controller;

use PremierBundle\Entity\SousProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;


class SousProduitController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sousProduits = $em->getRepository('PremierBundle:SousProduit')->findAll();

        return $this->render('@Premier/sousproduit/index.html.twig', array(
            'sousProduits' => $sousProduits,
        ));
    }


    public function newAction(Request $request)
    {
        $sousProduit = new Sousproduit();
        $form = $this->createForm('PremierBundle\Form\SousProduitType', $sousProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousProduit);
            $em->flush();

            return $this->redirectToRoute('ajouter_sous_produit', array('id' => $sousProduit->getId()));
        }

        return $this->render('@Premier/sousproduit/new.html.twig', array(
            'sousProduit' => $sousProduit,
            'form' => $form->createView(),
        ));
    }


    public function showAction(SousProduit $sousProduit)
    {
        $deleteForm = $this->createDeleteForm($sousProduit);

        return $this->render('sousproduit/show.html.twig', array(
            'sousProduit' => $sousProduit,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, SousProduit $sousProduit)
    {
        $deleteForm = $this->createDeleteForm($sousProduit);
        $editForm = $this->createForm('PremierBundle\Form\SousProduitType', $sousProduit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sousproduit_edit', array('id' => $sousProduit->getId()));
        }

        return $this->render('sousproduit/edit.html.twig', array(
            'sousProduit' => $sousProduit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, SousProduit $sousProduit)
    {
        $form = $this->createDeleteForm($sousProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousProduit);
            $em->flush();
        }

        return $this->redirectToRoute('sousproduit_index');
    }


    private function createDeleteForm(SousProduit $sousProduit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sousproduit_delete', array('id' => $sousProduit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
