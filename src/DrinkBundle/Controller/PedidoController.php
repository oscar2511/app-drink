<?php

namespace DrinkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DrinkBundle\Entity\Pedido;
use DrinkBundle\Form\PedidoType;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Pedido controller.
 *
 * @Route("/pedido")
 */
class PedidoController extends Controller
{





    /**
     * Lists all Pedido entities.
     *
     * @Route("/", name="pedido_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('DrinkBundle:Pedido')->findBy(array(),array('id'=>'DESC'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate( $pedidos,
            $this->get('request')->query->get('page', 1),5
        );

        return $this->render('DrinkBundle:Pedido:index.html.twig', array(
            'pedidos' => $pagination,
        ));
    }

    /**
     * Creates a new Pedido entity.
     *
     * @Route("/new", name="pedido_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pedido = new Pedido();
        $form = $this->createForm(new PedidoType(), $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('pedido_show', array('id' => $pedido->getId()));
        }

        return $this->render('DrinkBundle:Pedido:new.html.twig', array(
            'pedido' => $pedido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pedido entity.
     *
     * @Route("/{id}", name="pedido_show")
     * @Method("GET")
     */
    public function showAction(Pedido $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);


        $em = $this->getDoctrine()->getManager();

        $detallePedido = $em->getRepository('DrinkBundle:DetallePedido')
            ->findBy(array(
                'pedido' => $pedido
            ));

        //var_dump($detallePedido); die;

        return $this->render('DrinkBundle:Pedido:show.html.twig', array(
            'pedido'         => $pedido,
            'detallesPedido' => $detallePedido,
            'delete_form'    => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pedido entity.
     *
     * @Route("/{id}/edit", name="pedido_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pedido $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);
        $editForm = $this->createForm(new PedidoType(), $pedido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('pedido_edit', array('id' => $pedido->getId()));
        }

        return $this->render('DrinkBundle:Pedido:edit.html.twig', array(
            'pedido' => $pedido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pedido entity.
     *
     * @Route("/{id}", name="pedido_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pedido $pedido)
    {
        $form = $this->createDeleteForm($pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pedido);
            $em->flush();
        }

        return $this->redirectToRoute('pedido_index');
    }

    /**
     * Creates a form to delete a Pedido entity.
     *
     * @param Pedido $pedido The Pedido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pedido $pedido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pedido_delete', array('id' => $pedido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Lists all Pedido entities.
     *
     * @Route("/ajax/cambiar-estado/", name="pedido_cambiar_estado")
     * @Method("POST")
     */
    public function ajaxCambiarEstadoAction(Request $request)
    {

        try {
            $em = $this->getDoctrine()->getManager();

            $a = $request->request->all();
            foreach ($a as $key => $value)
                $datosDispositivo = json_decode($key);

            $estado = $em->getRepository('DrinkBundle:EstadoPedido')
                ->find($datosDispositivo->estado);

            $pedido = $em->getRepository('DrinkBundle:Pedido')
                ->find($datosDispositivo->idPedido);

            $pedido->setEstado($estado);

            $em->persist($pedido);
            $em->flush();

            return new JsonResponse(array(
                    "estado"       => 200,
                    "mensaje"      => "OK",
                    "nuevo_estado" => $estado->getNombre()
                )
            );

        } catch (\Exception $e) {
            return new JsonResponse(array(
                    "estado" => 400,
                    "mensaje" => "Error"
                )
            );
        }
    }


}
