<?php

namespace DrinkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DrinkBundle\Entity\Producto;
use DrinkBundle\Form\ProductoType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Producto controller.
 *
 */
class ProductoController extends Controller
{
    /**
     * Lists all Producto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('DrinkBundle:Producto')->findBy(array(),array('id'=>'DESC'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate( $productos,
            $this->get('request')->query->get('page', 1),5
        );

        return $this->render('DrinkBundle:Producto:index.html.twig', array(
            'productos' => $pagination,
        ));
    }

    /**
     * Creates a new Producto entity.
     *
     */
    public function newAction(Request $request)
    {
        $producto = new Producto();
        $form = $this->createForm(new ProductoType(), $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            return $this->redirectToRoute('producto_show', array('id' => $producto->getId()));
        }

        return $this->render('DrinkBundle:Producto:new.html.twig', array(
            'producto' => $producto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Producto entity.
     *
     */
    public function showAction(Producto $producto)
    {
        $deleteForm = $this->createDeleteForm($producto);

        return $this->render('DrinkBundle:Producto:show.html.twig', array(
            'producto' => $producto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Editar producto
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $em       = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('DrinkBundle:Producto')->find((int) $id);

        $categorias = $em->getRepository('DrinkBundle:Categoria')->findAll();

        return $this->render('DrinkBundle:Producto:edit.html.twig', array(
            'producto'   => $producto,
            'categorias' => $categorias
        ));
    }


    public function editAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $productoData = $request->request->all();
        //var_dump($a['nombre']); die;

        $producto = $em->getRepository('DrinkBundle:Producto')->find((int) $productoData['id']);
        $categoria = $em->getRepository('DrinkBundle:Categoria')->find($productoData['categoria']);


        $producto->setCategoria($categoria);
        $producto->setNombre($productoData['nombre']);
        $producto->setPrecio($productoData['precio']);
        $producto->setDescripcion($productoData['descripcion']);
        $producto->setStock($productoData['stock']);

        $em->persist($producto);
        $em->flush();

        return new JsonResponse(array(
                "estado"       => 200,
                "mensaje"      => "OK"
            )
        );



    }

    /**
     * Deletes a Producto entity.
     *
     */
    public function deleteAction(Request $request, Producto $producto)
    {
        $form = $this->createDeleteForm($producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($producto);
            $em->flush();
        }

        return $this->redirectToRoute('producto_index');
    }

    /**
     * Creates a form to delete a Producto entity.
     *
     * @param Producto $producto The Producto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Producto $producto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_delete', array('id' => $producto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
