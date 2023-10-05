<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of VoyagesController
 *
 * @author Damien
 */
class VoyagesController extends AbstractController{
    /**
     * @Route("/voyages", name = "voyages")
     * @return response
     */
    public function index() : Response{
        return $this->render("pages/voyages.html.twig");
    }
}
