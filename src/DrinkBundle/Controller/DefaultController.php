<?php

namespace DrinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DrinkBundle:Default:index.html.twig');
    }
}
