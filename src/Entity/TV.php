<?php

namespace App\Entity;

use DateTime;
class TV
{
    private int $id;
    private ?string $name;
    private ?string $language;
    private ?string $country;
    private ?int $seasons;
    private ?int $episodes;
    private ?int $grades;
    private ?string $image;
    private ?string $director;
    private ?DateTime $startDate;
    private ?int $status;
    private ?bool $isAdult;
}