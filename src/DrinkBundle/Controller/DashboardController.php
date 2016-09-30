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
        $fechaActual = date_format(new \DateTime("now"), 'Y-m-d');

        $fechaSemana    = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
        $fechaDosSemana = strtotime ( '-14 day' , strtotime ( $fechaActual ) ) ;

        $fechaUnaSemana = date_format(new \DateTime('@'.$fechaSemana),'Y-m-d');
        $fechaDosSemana = date_format(new \DateTime('@'.$fechaDosSemana),'Y-m-d');


        $q = $em->createQueryBuilder()
            ->select('p')
            ->from('DrinkBundle:Pedido', 'p')
            ->where('p.fecha <= :fechaActual')
            ->andWhere('p.fecha >= :fechaUnaSemana')
            ->andWhere('p.estado =4')
            ->setParameter('fechaActual', $fechaActual)
            ->setParameter('fechaUnaSemana', $fechaDosSemana)
            ->getQuery()
            ->getResult();

        $datosUnaSemana = array();
        foreach($q as $value) {
            $datosUnaSemana['fecha'] = date_format($value->getFecha(), 'd-m-Y');
            $datosUnaSemana['total'] = $value->getTotal();
        }

            //var_dump($datosUnaSemana);

        // die;

        $countDispositivos = $em->createQuery('SELECT COUNT(d.id) FROM
                                          DrinkBundle:Dispositivo d
                                          ')
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
