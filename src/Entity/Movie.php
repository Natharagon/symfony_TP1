<?php

namespace App\Entity;
use DateTime;
use Doctrine\Common\Collections\Collection;
class Movie 
{
    # Attributes
    private int $id;
    private ?string $title;
    private ?Collection $image;
    private ?Collection $video;
    private ?string $synopsis;
    private ?string $language;
    private ?bool $isAdult;
    private ?DateTime $releaseDate;
    private ?float $grade;
    private ?Collection $themes;
}