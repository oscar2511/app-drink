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

class DispositivoController extends FOSRestController
{

     /**
     *
     * @return object
     *
     * @View()
     * @Get("/dispositivo")
     */
    public function getDispositivoAction(){

        $em = $this->getDoctrine()->getManager();

        $dispositivo = $em->getRepository('DrinkBundle:Dispositivo')->findAll();

        return array($dispositivo);
    }

    /**
     *
     * @return object
     *
     * @View()
     * @Get("/dispositivo/administradores")
     */
    public function getAdministradoresAction(){

        $em = $this->getDoctrine()->getManager();

        $dql = 'SELECT d
                    FROM DrinkBundle:Dispositivo d
                    WHERE d.esAdministrador = 1';

        $consulta = $em->createQuery($dql);

        return $consulta->getResult();


        $dispositivo = $em->getRepository('DrinkBundle:Dispositivo')->findAll();

        return array($dispositivo);
    }


    /**
     * Create a new Task
     * @var Request $request
     * @return View|array
     *
     * @View()
     * @Post("/dispositivo/uuid")
     */
    public function getDispositivoByUuidAction( Request $request)
    {
        $fechaActual = new \DateTime("now");

        $a = $request->request->all();
        foreach($a as $key=>$value)
            $datosDispositivo = json_decode($key);


        $uuid  = $datosDispositivo->uuid;
        $token = $datosDispositivo->token;



        $em          = $this->getDoctrine()->getManager();
        $dispositivo = $em->getRepository('DrinkBundle:Dispositivo')
            ->findOneBy(array('uuid' =>(int) $uuid));


        if(!$dispositivo){
            $dispositvoEntity = new Dispositivo();

            $dispositvoEntity->setFechaCreate($fechaActual);
            $dispositvoEntity->setToken($token);
            $dispositvoEntity->setUuid($uuid);
            $dispositvoEntity->setEsAdministrador(0);
            $dispositvoEntity->setEstaBloqueado(0);

            $em->persist($dispositvoEntity);
            $em->flush();
        }else {
            $dispositivo->setToken(1234567);
            $dispositivo->setFechaUpdate($fechaActual);
            $em->persist($dispositivo);
            $em->flush();

            $dql = 'SELECT p
                    FROM DrinkBundle:Pedido p
                    JOIN p.dispositivo d
                    WHERE p.dispositivo =:dis
                    ORDER BY p.id DESC';

            $consulta = $em->createQuery($dql);
            $consulta->setParameter('dis', 1);

            $consulta->setMaxResults(1);
            return $consulta->getResult();

        }




        return array($dispositivo);
    }






}
