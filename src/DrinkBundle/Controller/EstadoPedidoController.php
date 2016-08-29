<?php

namespace DrinkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DrinkBundle\Entity\EstadoPedido;
use DrinkBundle\Form\EstadoPedidoType;

/**
 * EstadoPedido controller.
 *
 * @Route("/estadoPedido")
 */
class EstadoPedidoController extends Controller
{
    /**
     * Lists all EstadoPedido entities.
     *
     * @Route("/", name="estadoPedido_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estadoPedido = $em->getRepository('DrinkBundle:EstadoPedido')->findAll();

        return $this->render('DrinkBundle:EstadoPedido:index.html.twig', array(
            'estadoPedido' => $estadoPedido,
        ));
    }

    /**
     * Creates a new EstadoPedido entity.
     *
     * @Route("/new", name="estadoPedido_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $estadoPedido = new EstadoPedido();
        $form = $this->createForm(new EstadoPedidoType(), $estadoPedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadoPedido);
            $em->flush();

            return $this->redirectToRoute('estadoPedido_show', array('id' => $estadoPedido->getId()));
        }

        return $this->render('DrinkBundle:EstadoPedido:new.html.twig', array(
            'estadoPedido' => $estadoPedido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EstadoPedido entity.
     *
     * @Route("/{id}", name="estadoPedido_show")
     * @Method("GET")
     */
    public function showAction(EstadoPedido $estadoPedido)
    {
        $deleteForm = $this->createDeleteForm($estadoPedido);

        return $this->render('DrinkBundle:EstadoPedido:show.html.twig', array(
            'estadoPedido' => $estadoPedido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EstadoPedido entity.
     *
     * @Route("/{id}/edit", name="estadoPedido_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EstadoPedido $estadoPedido)
    {
        $deleteForm = $this->createDeleteForm($estadoPedido);
        $editForm = $this->createForm(new EstadoPedidoType(), $estadoPedido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadoPedido);
            $em->flush();

            return $this->redirectToRoute('estadoPedido_edit', array('id' => $estadoPedido->getId()));
        }

        return $this->render('DrinkBundle:EstadoPedido:edit.html.twig', array(
            'estadoPedido' => $estadoPedido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a EstadoPedido entity.
     *
     * @Route("/{id}", name="estadoPedido_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EstadoPedido $estadoPedido)
    {
        $form = $this->createDeleteForm($estadoPedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estadoPedido);
            $em->flush();
        }

        return $this->redirectToRoute('estadoPedido_index');
    }

    /**
     * Creates a form to delete a EstadoPedido entity.
     *
     * @param EstadoPedido $estadoPedido The EstadoPedido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EstadoPedido $estadoPedido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estadoPedido_delete', array('id' => $estadoPedido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
