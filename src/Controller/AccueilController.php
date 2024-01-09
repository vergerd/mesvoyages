<?php
namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author emds
 */
class AccueilController extends AbstractController{
    
    const PAGE_ACCUEIL = "pages/accueil.html.twig";
    
    /**
     *
     * @var VisiteRepository
     */
    private $repository;

    /**
     *
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
    
    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response{
        $visites = $this->repository->findAllLasted(2);
        return $this->render(self::PAGE_ACCUEIL, [
            'visites' => $visites
        ]);
    }
}
