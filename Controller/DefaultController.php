<?php

namespace Miky\Bundle\CategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MikyCategoryBundle:Default:index.html.twig');
    }
}
