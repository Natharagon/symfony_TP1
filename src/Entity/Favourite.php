<?php

namespace App\Entity;

use App\Repository\FavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavouriteRepository::class)]
class Favourite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $movieId = null;

    #[ORM\Column(nullable: true)]
    private ?int $tvId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    public function setMovieId(?int $movieId): static
    {
        $this->movieId = $movieId;

        return $this;
    }

    public function getTvId(): ?int
    {
        return $this->tvId;
    }

    public function setTvId(?int $tvId): static
    {
        $this->tvId = $tvId;

        return $this;
    }
}
