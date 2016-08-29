<?php

namespace DrinkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DrinkBundle\Entity\DetallePedido;
use DrinkBundle\Form\DetallePedidoType;

/**
 * DetallePedido controller.
 *
 * @Route("/detallepedido")
 */
class DetallePedidoController extends Controller
{
    /**
     * Lists all DetallePedido entities.
     *
     * @Route("/", name="detallepedido_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $detallePedidos = $em->getRepository('DrinkBundle:DetallePedido')->findAll();

        return $this->render('DrinkBundle:DetallePedido:index.html.twig', array(
            'detallePedidos' => $detallePedidos,
        ));
    }

    /**
     * Creates a new DetallePedido entity.
     *
     * @Route("/new", name="detallepedido_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $detallePedido = new DetallePedido();
        $form = $this->createForm(new DetallePedidoType(), $detallePedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detallePedido);
            $em->flush();

            return $this->redirectToRoute('detallepedido_show', array('id' => $detallePedido->getId()));
        }

        return $this->render('DrinkBundle:DetallePedido:new.html.twig', array(
            'detallePedido' => $detallePedido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DetallePedido entity.
     *
     * @Route("/{id}", name="detallepedido_show")
     * @Method("GET")
     */
    public function showAction(DetallePedido $detallePedido)
    {
        $deleteForm = $this->createDeleteForm($detallePedido);

        return $this->render('detallepedido/show.html.twig', array(
            'detallePedido' => $detallePedido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DetallePedido entity.
     *
     * @Route("/{id}/edit", name="detallepedido_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DetallePedido $detallePedido)
    {
        $deleteForm = $this->createDeleteForm($detallePedido);
        $editForm = $this->createForm(new DetallePedidoType(), $detallePedido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detallePedido);
            $em->flush();

            return $this->redirectToRoute('detallepedido_edit', array('id' => $detallePedido->getId()));
        }

        return $this->render('DrinkBundle:DetallePedido:edit.html.twig', array(
            'detallePedido' => $detallePedido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DetallePedido entity.
     *
     * @Route("/{id}", name="detallepedido_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DetallePedido $detallePedido)
    {
        $form = $this->createDeleteForm($detallePedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($detallePedido);
            $em->flush();
        }

        return $this->redirectToRoute('detallepedido_index');
    }

    /**
     * Creates a form to delete a DetallePedido entity.
     *
     * @param DetallePedido $detallePedido The DetallePedido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DetallePedido $detallePedido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detallepedido_delete', array('id' => $detallePedido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
