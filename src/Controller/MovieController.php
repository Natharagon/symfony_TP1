<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/movie')]
class MovieController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
    ) {}

    #[Route('/all')]
    public function getMovies(): Response
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/movie/popular?api_key=c3262e5d343c3b0b8c7483a101a54078'
        );

        $content = $response->getContent();
        $content = json_decode($content);
        $content = json_encode($content->results);
        return new Response($content);
    }
}