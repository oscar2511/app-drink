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

        $countDispositivos = $em->createQuery('SELECT COUNT(d.id) FROM
                                          DrinkBundle:Dispositivo d
                                           WHERE d.estaBloqueado=0')
                            ->getSingleScalarResult();

        $sumaVentas = $em->createQuery('SELECT SUM (p.total) FROM
                        DrinkBundle:Pedido p
                        WHERE p.estado=4')
                    ->getSingleScalarResult();

        $ventasConcretadas = $em->createQuery('SELECT COUNT(p.id) FROM
                                          DrinkBundle:Pedido p
                                           WHERE p.estado=4')
            ->getSingleScalarResult();

        $ventasCanceladas = $em->createQuery('SELECT COUNT(p.id) FROM
                                          DrinkBundle:Pedido p
                                           WHERE p.estado=3')
            ->getSingleScalarResult();


        //$pedidos = $em->getRepository('DrinkBundle:Pedido')->findAll();
        return $this->render('DrinkBundle:Dashboard:index.html.twig', array(
            'dispositivos'      => $countDispositivos,
            'ventasTotal'       => $sumaVentas,
            'ventasConcretadas' => $ventasConcretadas,
            'ventasCanceladas'  => $ventasCanceladas
        ));
    }


}
