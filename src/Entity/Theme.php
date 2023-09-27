<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Theme
{
    private int $id;
    private string $name;
    private Collection $movies;
    private Collection $tv;

    # Functions
    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->tv = new ArrayCollection();
    }
    
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

    public function addMovie(Movie $movie): static
    {
        if (!$this->movies->contains($movie)){
            $this->movies->add($movie);
            $movie->addTheme($this);
        }
        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        if ($this->movies->removeElement($movie)) {
            if ($movie->getThemes()->contains($this)) {
                $movie->removeTheme($this);
            }
        }
        return $this;
    }

    /**
     * Get the value of tv
     */
    public function getTv(): Collection
    {
        return $this->tv;
    }

    /**
     * Set the value of tv
     */
    public function setTv(Collection $tv): self
    {
        $this->tv = $tv;

        return $this;
    }

    public function addTv(TV $tv): static
    {
        if (!$this->tv->contains($tv)){
            $this->tv->add($tv);
            $tv->addTheme($this);
        }
        return $this;
    }

    public function removeTv(TV $tv): static
    {
        if ($this->tv->removeElement($tv)) {
            if ($tv->getThemes()->contains($this)) {
                $tv->removeTheme($this);
            }
        }
        return $this;
    }
}