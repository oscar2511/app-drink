<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DrinkBundle\Entity\Pedido;
use DrinkBundle\Form\PedidoType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $pedido = new Pedido();
        $form = $this->createForm(new PedidoType(), $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('pedido_show', array('id' => $pedido->getId()));
        }

        return $this->render('DrinkBundle:Pedido:new.html.twig', array(
            'pedido' => $pedido,
            'form' => $form->createView(),
        ));


        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));*/
    }
}
