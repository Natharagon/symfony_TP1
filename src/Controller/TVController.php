<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Favourite;
use App\Entity\TV;
use App\Entity\Review;
use App\Entity\Theme;
use App\Form\FavouriteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Image;

#[Route('/tv')]
class TVController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $tmdbClient,
    ) {}

    #[Route('/all')]
    public function getTvs(): Response
    {
        $response = $this->tmdbClient->request(
            'GET',
            '/3/tv/popular'
        );
        $apiTvs = $response->toArray()['results'];
        $tvs = [];
        for ($i=0; $i<10; $i++){
            $apiTv = $apiTvs[$i];
            $tv = new tv();
            $tv->setId($apiTv['id']);
            $tv->setName($apiTv['name']);
            $tv->setLanguage($apiTv['original_language']);
            $image = new Image();
            $image->setPath('https://image.tmdb.org/t/p/original' . $apiTv['poster_path']);
            $tv->addImage($image);
            $tv->setStartDate(new \DateTime($apiTv['first_air_date']));
            $tv->setOverview(($apiTv['overview']));
            $tv->setGrade($apiTv['vote_average']);
            $tvs[] = $tv;
        }

        $content = $response->getContent();
        $content = json_decode($content)->results;
        
        return $this->render('tv/popular.html.twig', [
            'tvs' => $tvs,
        ]);

    }

    #[Route('/{id}')]
    public function getTv(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $response = $this->tmdbClient->request(
            'GET',
            '/3/tv/' . $id
        );

        $apiTv = json_decode($response->getContent());

        $tv = new tv();
        $tv->setId($apiTv->id);
        $tv->setName($apiTv->name);
        foreach($apiTv->genres as $genre) {
            $theme = new Theme();
            $theme->setName($genre->name);
            $tv->addTheme($theme);
        }
        $tv->setLanguage($apiTv->original_language);
        $image = new Image();
        $image->setPath('https://image.tmdb.org/t/p/original' . $apiTv->poster_path);
        $tv->addImage($image);
        $tv->setStartDate(new \DateTime($apiTv->first_air_date));
        $tv->setOverview(($apiTv->overview));
        $tv->setGrade($apiTv->vote_average);

        $casting = $this->tmdbClient->request(
            'GET',
            '/3/tv/' . $apiTv->id . '/credits'
        );
        $apiCasting = json_decode($casting->getContent());
        foreach($apiCasting->cast as $apiActor) {
            $actor = new Actor();
            $actor->setName($apiActor->name);
            $tv->addActor($actor);
        }

        $reviews = $this->tmdbClient->request(
            'GET',
            '/3/tv/' . $apiTv->id . '/reviews'
        );
        $reviews = json_decode($reviews->getContent());
        foreach($reviews->results as $apiReview) {
            $review = new Review();
            $review->setComment($apiReview->content);
            $review->setGrade($apiReview->author_details->rating);
            $review->setUsername($apiReview->author_details->username);
            $tv->addReview($review);
        }

        $favouriteRepository = $entityManager->getRepository(Favourite::class);
        $favourite = $favouriteRepository->findOneBy(['tvId' => $tv->getId()]);
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
        }
        
        return $this->render('tv/tvById.html.twig', [
            'tv' => $tv,
            'form' => $form,
            'favouriteExists' => $favouriteExists
        ]);
        
    }
}