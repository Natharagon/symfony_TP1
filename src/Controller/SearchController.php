<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Movie;
use App\Entity\TV;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $tmdbClient,
    ) {}

    #[Route('/search', name: 'app_search')]
    public function index(Request $request): Response
    {
        $searchTerms = $request->query->get("searchTerms");
        $searchResults = $this->tmdbClient->request(
            'GET',
            '/3/search/multi?query=' . $searchTerms
        );

        $apiResults = $searchResults->toArray()["results"];
        $results = [];
        foreach ($apiResults as $result){
            if ($result["media_type"]==="movie") {
                $newResult = new Movie();
                $newResult->setId($result["id"]);
                $newResult->setTitle($result["title"]);
                $image = new Image();
                $image->setPath('https://image.tmdb.org/t/p/original' . $result["poster_path"]);
                $newResult->addImage($image);
                $newResult->setReleaseDate(new \DateTime($result["release_date"]));
                $newResult->setGrade($result["vote_average"]);
                $results[] = $newResult;
            }
            else if ($result["media_type"]==="tv") {
                $newResult = new tv();
                $newResult->setId($result["id"]);
                $newResult->setName($result["name"]);
                $image = new Image();
                $image->setPath('https://image.tmdb.org/t/p/original' . $result["poster_path"]);
                $newResult->addImage($image);
                $newResult->setStartDate(new \DateTime($result["first_air_date"]));
                $newResult->setGrade($result["vote_average"]);
                $results[] = $newResult;
            }
        }

        return $this->render('search/index.html.twig', [
            'results' => $results
        ]);
    }
}
