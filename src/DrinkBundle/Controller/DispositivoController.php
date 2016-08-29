<?php

namespace DrinkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DrinkBundle\Entity\Dispositivo;
use DrinkBundle\Form\DispositivoType;

/**
 * Dispositivo controller.
 *
 * @Route("/dispositivo")
 */
class DispositivoController extends Controller
{
    /**
     * Lists all Dispositivo entities.
     *
     * @Route("/", name="dispositivo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dispositivos = $em->getRepository('DrinkBundle:Dispositivo')->findAll();

        return $this->render('DrinkBundle:Dispositivo:index.html.twig', array(
            'dispositivos' => $dispositivos,
        ));
    }

    /**
     * Creates a new Dispositivo entity.
     *
     * @Route("/new", name="dispositivo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dispositivo = new Dispositivo();
        $form = $this->createForm(new DispositivoType(), $dispositivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dispositivo);
            $em->flush();

            return $this->redirectToRoute('dispositivo_show', array('id' => $dispositivo->getId()));
        }

        return $this->render('DrinkBundle:Dispositivo:new.html.twig', array(
            'dispositivo' => $dispositivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Dispositivo entity.
     *
     * @Route("/{id}", name="dispositivo_show")
     * @Method("GET")
     */
    public function showAction(Dispositivo $dispositivo)
    {
        $deleteForm = $this->createDeleteForm($dispositivo);

        return $this->render('DrinkBundle:Dispositivo:show.html.twig', array(
            'dispositivo' => $dispositivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dispositivo entity.
     *
     * @Route("/{id}/edit", name="dispositivo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dispositivo $dispositivo)
    {
        $deleteForm = $this->createDeleteForm($dispositivo);
        $editForm = $this->createForm(new DispositivoType(), $dispositivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dispositivo);
            $em->flush();

            return $this->redirectToRoute('dispositivo_edit', array('id' => $dispositivo->getId()));
        }

        return $this->render('DrinkBundle:Dispositivo:edit.html.twig', array(
            'dispositivo' => $dispositivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dispositivo entity.
     *
     * @Route("/{id}", name="dispositivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dispositivo $dispositivo)
    {
        $form = $this->createDeleteForm($dispositivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dispositivo);
            $em->flush();
        }

        return $this->redirectToRoute('dispositivo_index');
    }

    /**
     * Creates a form to delete a Dispositivo entity.
     *
     * @param Dispositivo $dispositivo The Dispositivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dispositivo $dispositivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dispositivo_delete', array('id' => $dispositivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
