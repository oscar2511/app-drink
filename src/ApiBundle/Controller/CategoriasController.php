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
use DrinkBundle\Entity\Categoria;

class CategoriasController extends FOSRestController
{

     /**
     * Get todas las categorias
     * @return array
     *
     * @View()
     * @Get("/categorias")
     */
    public function getCategoriasAction(){

        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('DrinkBundle:Categoria')->findAll();

        return array($categorias);
    }

}
