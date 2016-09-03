<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use DrinkBundle\Entity\Dispositivo;
use DrinkBundle\Entity\Pedido;
use DrinkBundle\Entity\DetallePedido;

class PedidoController extends FOSRestController
{

    /**
     * Registrar un nuevo pedido
     * @var Request $request
     * @return View|array
     *
     * @View()
     * @Post("/pedido/nuevo")
     */
    public function pedidoNuevoAction( Request $request)
    {
        $fechaActual = new \DateTime("now");

        $info = $request->getContent();
        $data = json_decode($info,true);

        $em = $this->getDoctrine()->getManager();
        $disp = $em->getRepository('DrinkBundle:Dispositivo')->findOneBy(array(
            'uuid' => $data['dispositivo']['uuid']
        ));

        $estadoPedido = $em->getRepository('DrinkBundle:EstadoPedido')->findOneBy(array(
            'id' => 1
        ));

        $pedidoEntity = new Pedido();

        $pedidoEntity->setNumero($data['numero']);
        $pedidoEntity->setSubTotal($data['subTotal']);
        $pedidoEntity->setTotal($data['total']);
        $pedidoEntity->setFecha($fechaActual);
        $pedidoEntity->setCalle($data['ubicacion']['direccion']['calle']);
        $pedidoEntity->setNro($data['ubicacion']['direccion']['numero']);
        $pedidoEntity->setLatitud($data['ubicacion']['coordenadas']['lat']);
        $pedidoEntity->setLongitud($data['ubicacion']['coordenadas']['long']);
        $pedidoEntity->setTelefono($data['ubicacion']['referencia']['tel']);
        $pedidoEntity->setDirReferencia($data['ubicacion']['referencia']['dir_ref']);
        $pedidoEntity->setDispositivo($disp);
        $pedidoEntity->setEstado($estadoPedido);
        $pedidoEntity->setFechaUpdate($fechaActual);

        $em->persist($pedidoEntity);
        $em->flush();


        /** insertar en la tabla detalle pedido */
        for($i=1;$i<count($data['detalle']); $i++) {

            $detallePedidoEntity = new DetallePedido();
            $productoEntity = $em->getRepository('DrinkBundle:Producto')->findOneBy(array(
                'id' => $data['detalle'][$i]['producto']['id']
                ));

            $detallePedidoEntity->setCantidad($data['detalle'][$i]['cantidad']);
            $detallePedidoEntity->setPedido($pedidoEntity);
            $detallePedidoEntity->setSubTotal($data['detalle'][$i]['subTotal']);
            $detallePedidoEntity->setProducto($productoEntity);

            $em->persist($detallePedidoEntity);
            $em->flush();
        }


        return array("Ok");
    }






}
