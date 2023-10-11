<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Favourite;
use App\Entity\Movie;
use App\Entity\Review;
use App\Entity\Theme;
use App\Form\FavouriteType;
use App\Repository\FavouriteRepository;
use Symfony\Component\HttpFoundation\Request;
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
        private FavouriteRepository $favouriteRepository
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
            $movie->setId($apiMovie['id']);
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

    #[Route('/{id}')]
    public function getMovie(int $id, Request $request): Response
    {
        $response = $this->tmdbClient->request(
            'GET',
            '/3/movie/' . $id
        );

        $apiMovie = json_decode($response->getContent());

        $movie = new Movie();
        $movie->setId($apiMovie->id);
        $movie->setTitle($apiMovie->title);
        foreach($apiMovie->genres as $genre) {
            $theme = new Theme();
            $theme->setName($genre->name);
            $movie->addTheme($theme);
        }
        $movie->setLanguage($apiMovie->original_language);
        $image = new Image();
        $image->setPath('https://image.tmdb.org/t/p/original' . $apiMovie->poster_path);
        $movie->addImage($image);
        $movie->setReleaseDate(new \DateTime($apiMovie->release_date));
        $movie->setSynopsis(($apiMovie->overview));
        $movie->setIsAdult($apiMovie->adult);
        $movie->setGrade($apiMovie->vote_average);

        $casting = $this->tmdbClient->request(
            'GET',
            '/3/movie/' . $apiMovie->id . '/credits'
        );
        $apiCasting = json_decode($casting->getContent());
        foreach($apiCasting->cast as $apiActor) {
            $actor = new Actor();
            $actor->setName($apiActor->name);
            $movie->addActor($actor);
        }

        $reviews = $this->tmdbClient->request(
            'GET',
            '/3/movie/' . $apiMovie->id . '/reviews'
        );
        $reviews = json_decode($reviews->getContent());
        foreach($reviews->results as $apiReview) {
            $review = new Review();
            $review->setComment($apiReview->content);
            $review->setGrade($apiReview->author_details->rating);
            $review->setUsername($apiReview->author_details->username);
            $movie->addReview($review);
        }

        $favourite = new Favourite();
        $form = $this->createForm(FavouriteType::class, $favourite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $favourite = $form->getData();


            // ... perform some action, such as saving the task to the database
        }

        return $this->render('movie/movieById.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
        
    }
}