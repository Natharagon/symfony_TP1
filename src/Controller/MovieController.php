<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Image;

#[Route('/movie')]
class MovieController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $tmdbClient,
    ) {}

    #[Route('/all')]
    public function getMovies(): Response
    {
        $response = $this->tmdbClient->request(
            'GET',
            '/3/movie/popular'
        );

        $apiMovies = $response->toArray()['results'];
        $movies = [];
        for ($i=0; $i<10; $i++){
            $apiMovie = $apiMovies[$i];
            $movie = new Movie();
            $movie->setTitle($apiMovie['title']);
            $movie->setLanguage($apiMovie['original_language']);
            $image = new Image();
            $image->setPath('https://image.tmdb.org/t/p/original' . $apiMovie['poster_path']);
            $movie->addImage($image);
            $movie->setReleaseDate(new \DateTime($apiMovie['release_date']));
            $movie->setSynopsis(($apiMovie['overview']));
            $movie->setIsAdult($apiMovie['adult']);
            $movie->setGrade($apiMovie['vote_average']);
            $movies[] = $movie;
        }

        $content = $response->getContent();
        $content = json_decode($content)->results;
        
        return $this->render('movie/popular.html.twig', [
            'movies' => $movies,
        ]);

        
    }
}