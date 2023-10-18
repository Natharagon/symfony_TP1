<?php

namespace App\Controller;

use App\Entity\Favourite;
use App\Entity\Image;
use App\Entity\Movie;
use App\Entity\TV;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FavouriteController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $tmdbClient,
    ) {}
    #[Route('/favourite', name: 'app_favourite')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $favouriteRepository = $entityManager->getRepository(Favourite::class);
        $favouritesList = $favouriteRepository->findAll();
        $favourites = [];

        foreach ($favouritesList as $favourite){
            if ($favourite->getTvId()==null){
                $response = $this->tmdbClient->request(
                    'GET',
                    '/3/movie/' . $favourite->getMovieId()
                );

                $apiMovie = json_decode($response->getContent());
                $movie = new Movie();
                $movie->setId($apiMovie->id);
                $movie->setTitle($apiMovie->title);
                $image = new Image();
                $image->setPath('https://image.tmdb.org/t/p/original' . $apiMovie->poster_path);
                $movie->addImage($image);
                $movie->setReleaseDate(new \DateTime($apiMovie->release_date));
                $movie->setGrade($apiMovie->vote_average);
                $favourites[] = $movie;
            }
            else {
                $response = $this->tmdbClient->request(
                    'GET',
                    '/3/tv/' . $favourite->getTvId()
                );

                $apiTv = json_decode($response->getContent());
                $tv = new tv();
                $tv->setId($apiTv->id);
                $tv->setName($apiTv->name);
                $image = new Image();
                $image->setPath('https://image.tmdb.org/t/p/original' . $apiTv->poster_path);
                $tv->addImage($image);
                $tv->setStartDate(new \DateTime($apiTv->first_air_date));
                $tv->setGrade($apiTv->vote_average);
                $favourites[] = $tv;
            }
        }


        return $this->render('favourite/index.html.twig', [
            'favourites' => $favourites,
        ]);
    }
}
