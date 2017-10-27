<?php

namespace PremierBundle\Controller;

use PremierBundle\Entity\SousProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sousproduit controller.
 *
 * @Route("sousproduit")
 */
class SousProduitController extends Controller
{
    /**
     * Lists all sousProduit entities.
     *
     * @Route("/", name="sousproduit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sousProduits = $em->getRepository('PremierBundle:SousProduit')->findAll();

        return $this->render('sousproduit/index.html.twig', array(
            'sousProduits' => $sousProduits,
        ));
    }

    /**
     * Creates a new sousProduit entity.
     *
     * @Route("/new", name="sousproduit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sousProduit = new Sousproduit();
        $form = $this->createForm('PremierBundle\Form\SousProduitType', $sousProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousProduit);
            $em->flush();

            return $this->redirectToRoute('sousproduit_show', array('id' => $sousProduit->getId()));
        }

        return $this->render('sousproduit/new.html.twig', array(
            'sousProduit' => $sousProduit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousProduit entity.
     *
     * @Route("/{id}", name="sousproduit_show")
     * @Method("GET")
     */
    public function showAction(SousProduit $sousProduit)
    {
        $deleteForm = $this->createDeleteForm($sousProduit);

        return $this->render('sousproduit/show.html.twig', array(
            'sousProduit' => $sousProduit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sousProduit entity.
     *
     * @Route("/{id}/edit", name="sousproduit_edit")
     * @Method({"GET", "POST"})
     */
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

    /**
     * Deletes a sousProduit entity.
     *
     * @Route("/{id}", name="sousproduit_delete")
     * @Method("DELETE")
     */
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

    /**
     * Creates a form to delete a sousProduit entity.
     *
     * @param SousProduit $sousProduit The sousProduit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SousProduit $sousProduit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sousproduit_delete', array('id' => $sousProduit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
