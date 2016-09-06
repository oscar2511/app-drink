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
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductoController extends FOSRestController
{

    /**
     * Get todas los productos
     * @return array
     *
     * @View()
     * @Get("/productos")
     */
    public function getProductoAction()
    {
        $em       = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('DrinkBundle:Producto')->findAll();

        return array($producto);
    }



    /**
     * Get productos de una categoria
     * @param $idCategoria
     * @return array
     *
     * @View()
     * @Get("/producto/{idCategoria}",)
     */
    public function getProductosByCategoriaAction($idCategoria)
    {
        $em = $this->getDoctrine()->getManager();

        $dql = 'SELECT p
                    FROM DrinkBundle:Producto p
                    WHERE p.categoria =:idCat';

        $consulta = $em->createQuery($dql);
        $consulta->setParameter('idCat', (int) $idCategoria);

        return $consulta->getResult();

    }


    /**
     * Cambiar el estado de stock de un producto
     * @var Request $request
     * @return json
     *
     * @View()
     * @Post("/producto/cambiar-stock")
     */
    public function cambiarEstadoStockAction(Request $request)
    {
        $info = $request->getContent();
        $data = json_decode($info,true);
        $em   = $this->getDoctrine()->getManager();

        $producto = $em->getRepository('DrinkBundle:Producto')->find($data['idProducto']);


        if(!$producto)
            return new JsonResponse(array(
                    "estado"  => 400,
                    "mensaje" => "No se encontro el producto"
                )
            );

        $producto->setStock($data['stockCambio']);

        $em->persist($producto);
        $em->flush();
        return new JsonResponse(array(
                "estado"  => 200,
                "mensaje" => "OK"
            )
        );



    }

}
