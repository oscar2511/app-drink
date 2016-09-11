<?php

namespace DrinkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Producto controller.
 *
 */
class DashboardController extends Controller
{
    /**
     * Lists all Producto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('DrinkBundle:Pedido')->findAll();

        return $this->render('DrinkBundle:Dashboard:index.html.twig', array(
            'pedidos' => $pedidos,
        ));
    }


}
