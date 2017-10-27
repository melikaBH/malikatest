<?php

namespace PremierBundle\Controller;

use PremierBundle\Entity\Achat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Achat controller.
 *
 * @Route("achat")
 */
class AchatController extends Controller
{
    /**
     * Lists all achat entities.
     *
     * @Route("/", name="achat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $achats = $em->getRepository('PremierBundle:Achat')->findAll();

        return $this->render('achat/index.html.twig', array(
            'achats' => $achats,
        ));
    }

    /**
     * Creates a new achat entity.
     *
     * @Route("/new", name="achat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $achat = new Achat();
        $form = $this->createForm('PremierBundle\Form\AchatType', $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($achat);
            $em->flush();

            return $this->redirectToRoute('achat_show', array('id' => $achat->getId()));
        }

        return $this->render('achat/new.html.twig', array(
            'achat' => $achat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a achat entity.
     *
     * @Route("/{id}", name="achat_show")
     * @Method("GET")
     */
    public function showAction(Achat $achat)
    {
        $deleteForm = $this->createDeleteForm($achat);

        return $this->render('achat/show.html.twig', array(
            'achat' => $achat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing achat entity.
     *
     * @Route("/{id}/edit", name="achat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Achat $achat)
    {
        $deleteForm = $this->createDeleteForm($achat);
        $editForm = $this->createForm('PremierBundle\Form\AchatType', $achat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('achat_edit', array('id' => $achat->getId()));
        }

        return $this->render('achat/edit.html.twig', array(
            'achat' => $achat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a achat entity.
     *
     * @Route("/{id}", name="achat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Achat $achat)
    {
        $form = $this->createDeleteForm($achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($achat);
            $em->flush();
        }

        return $this->redirectToRoute('achat_index');
    }

    /**
     * Creates a form to delete a achat entity.
     *
     * @param Achat $achat The achat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Achat $achat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achat_delete', array('id' => $achat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
