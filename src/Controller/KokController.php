<?php

namespace App\Controller;

use App\Repository\BestellingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KokController extends AbstractController
{
    /**
     * @Route("/kok", name="kok")
     */
    public function index(BestellingRepository $bestellingRepository): Response
    {
        return $this->render('bestelling/index.html.twig', [
            'bestellings' => $bestellingRepository->findAll(),
        ]);
    }
}
