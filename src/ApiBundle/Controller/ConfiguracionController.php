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


}
