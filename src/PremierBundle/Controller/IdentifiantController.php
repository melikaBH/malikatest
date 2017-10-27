<?php

namespace PremierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IdentifiantController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
