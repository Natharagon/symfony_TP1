<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavouriteController extends AbstractController
{
    #[Route('/favourite', name: 'app_favourite')]
    public function index(): Response
    {
        return $this->render('favourite/index.html.twig', [
            'controller_name' => 'FavouriteController',
        ]);
    }
}
