<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

class Theme
{
    private int $id;
    private string $name;
    private Collection $movies;

    # Getters and setters
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of movies
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    /**
     * Set the value of movies
     */
    public function setMovies(Collection $movies): self
    {
        $this->movies = $movies;

        return $this;
    }
}