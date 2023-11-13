<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Favourite;
use App\Entity\Movie;
use App\Entity\Review;
use App\Entity\Theme;
use App\Form\FavouriteType;
use App\Form\ReviewType;
use App\Repository\FavouriteRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function getMovie(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get the movie
        $response = $this->tmdbClient->request(
            'GET',
            '/3/movie/' . $id
        );

        $apiMovie = json_decode($response->getContent());

        // Create a movie object to pass to the template
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

        $reviewRepository = $entityManager->getRepository(Review::class);
        $databaseReviews = $reviewRepository->findOneByMovieId($id);
        foreach($databaseReviews as $dbReview) {
            $review = new Review();
            $review->setComment($dbReview->getComment());
            $review->setGrade($dbReview->getGrade());
            $review->setUsername($dbReview->getUsername());
            $movie->addReview($review);
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

        // Check if the movie is a Favourite and create a form accordingly
        $favouriteRepository = $entityManager->getRepository(Favourite::class);
        $favourite = $favouriteRepository->findOneBy(['movieId' => $movie->getId()]);
        if ($favourite==null) {
            $favourite = new Favourite();
            $favouriteExists = false;
        }
        else {
            $favouriteExists = true;
        }

        $form = $this->createForm(FavouriteType::class, $favourite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($favouriteExists) {
                $favouriteRepository->delete($favourite, true);
            }
            else {
                $favourite = $form->getData();
                $favouriteRepository->save($favourite, true);
            }
            return $this->redirect($request->getUri());
        }

        // Initiate a form for adding a review
        $reviewForm = $this->createForm(ReviewType::class, new Review());

        $reviewForm->handleRequest($request);
        if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $review = $reviewForm->getData();
            $reviewRepository->save($review, true);
            return $this->redirect($request->getUri());
        }

        return $this->render('movie/movieById.html.twig', [
            'movie' => $movie,
            'form' => $form,
            'favouriteExists' => $favouriteExists,
            'reviewForm' => $reviewForm
        ]);
        
    }
}