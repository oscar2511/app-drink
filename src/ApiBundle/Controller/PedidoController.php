<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
use Symfony\Component\Security\Acl\Exception\Exception;

class PedidoController extends FOSRestController
{



    /**
     * Get todos los pedidos
     * @return array
     *
     * @View()
     * @Get("/pedidos")
     */
    public function getPedidosAction(){

        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('DrinkBundle:Pedido')->findAll();

        return ($pedidos);
    }

    /**
     * Get todos los pedidos de un estado particular
     * @return array
     *
     * @View()
     * @Get("/pedidos/{estado}")
     */
    public function getPedidosEstadoAction($estado){

        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('DrinkBundle:Pedido')->findBy(array(
            'estado' => $estado
        ));

        return ($pedidos);
    }

    /**
     * Get pedido por id
     * @return array
     *
     * @View()
     * @Get("/pedido/{id}")
     */
    public function getPedidoAction($id)
    {
        $em  = $this->getDoctrine()->getManager();
        $dql = 'SELECT d
                    FROM DrinkBundle:DetallePedido d
                    JOIN d.pedido p
                    WHERE p.id =:idPedido';

        $consulta = $em->createQuery($dql);
        $consulta->setParameter('idPedido', $id);

        return $consulta->getResult();
    }


    /**
     * Cambiar el estado de un pedido
     * @var Request $request
     * @return json
     *
     * @View()
     * @Post("/pedido/estado")
     */
    public function cambiarEstadoAction( Request $request)
    {
        $em   = $this->getDoctrine()->getManager();
        $fechaActual = new \DateTime("now");

        $info = $request->getContent();
        $data = json_decode($info,true);
        try {
            $pedido = $em->getRepository('DrinkBundle:Pedido')->find($data['idPedido']);
            $estado = $em->getRepository('DrinkBundle:EstadoPedido')->find($data['estado']);

            $pedido->setEstado($estado);

            $em->persist($pedido);
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse(array(
                    "estado"    => 400
                )
            );
        }

        return new JsonResponse(array(
                "estado"    => 200
            )
        );

    }



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
        $error = "";

        $info = $request->getContent();
        $data = json_decode($info,true);
        $em   = $this->getDoctrine()->getManager();

        $disp = $em->getRepository('DrinkBundle:Dispositivo')->findOneBy(array(
            'uuid' => $data['dispositivo']['uuid']
        ));

        if(!$disp)
            return new JsonResponse(array(
                    "estado"  => 400,
                    "mensaje" => "No se encontro el dispositivo"
                )
            );

        $estadoPedido = $em->getRepository('DrinkBundle:EstadoPedido')->findOneBy(array(
            'id' => 1
        ));

        $pedidoEntity = new Pedido();

        try {
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

            /** insertar en la tabla detalle */
            for ($i = 1; $i < count($data['detalle']); $i++) {
                $detallePedidoEntity = new DetallePedido();
                $productoEntity = $em->getRepository('DrinkBundle:Producto')->findOneBy(array(
                    'id' => $data['detalle'][$i]['producto']['id']
                ));

                $detallePedidoEntity->setCantidad($data['detalle'][$i]['cantidad']);
                $detallePedidoEntity->setPedido($pedidoEntity);
                $detallePedidoEntity->setSubTotal($data['detalle'][$i]['subTotal']);
                $detallePedidoEntity->setProducto($productoEntity);

                $em->persist($detallePedidoEntity);
            }

            $em->flush();

        }catch (\Exception $e){
            return new JsonResponse(array(
                    "estado"  => 400,
                    "mensaje" => $error." ".$e
                )
            );
        }

        return new JsonResponse(array(
                "estado"    => 200,
                "id_pedido" => $pedidoEntity->getId()
            )
        );
    }






}
