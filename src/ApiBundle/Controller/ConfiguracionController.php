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
use DrinkBundle\Entity\Configuracion;
use Symfony\Component\HttpFoundation\JsonResponse;


class ConfiguracionController extends FOSRestController
{

     /**
     *
     * @return object
     *
     * @View()
     * @Get("/horario")
     */
    public function getEstadoAperturaAction(){

        $em      = $this->getDoctrine()->getManager();
        $horario = $em->getRepository('DrinkBundle:Configuracion')->findAll();

        return ($horario);
    }

    /**
     * Abre o cierra la aplicacion para atencion
     * @return object
     *
     * @View()
     * @Post("/horario/abrir-cerrar")
     */
    public function abrirCerrarAction(){

        try {
            $em = $this->getDoctrine()->getManager();
            $horario = $em->getRepository('DrinkBundle:Configuracion')->find(1);

            if ($horario->getEstaAbierto())
                $horario->setEstaAbierto(false);
            else
                $horario->setEstaAbierto(true);

            $em->persist($horario);
            $em->flush();

            return new JsonResponse(array(
                    "estado"  => 200,
                    "mensaje" => "OK"
                )
            );

        }catch (\Exception $e) {
            return new JsonResponse(array(
                    "estado" => 400,
                    "mensaje" => "Error"
                )
            );
        }

    }


}
