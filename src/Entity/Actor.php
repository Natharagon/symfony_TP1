<?php

namespace App\Entity;
use Doctrine\Common\Collections\Collection;

class Actor
{
    private int $id;
    private ?string $lastName;
    private ?string $firstName;
    private ?int $gender;
    private ?string $biography;
    private ?Collection $movies;
    private ?Collection $tv;
    

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
     * Get the value of lastName
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     */
    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of biography
     */
    public function getBiography(): ?string
    {
        return $this->biography;
    }

    /**
     * Set the value of biography
     */
    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get the value of movies
     */
    public function getMovies(): ?Collection
    {
        return $this->movies;
    }

    /**
     * Set the value of movies
     */
    public function setMovies(?Collection $movies): self
    {
        $this->movies = $movies;

        return $this;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movies->contains($movie)){
            $this->movies->add($movie);
            $movie->addActor($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        if ($this->movies->removeElement($movie)) {
            if ($movie->getActors()->contains($this)) {
                $movie->removeActor($this);
            }
        }
        return $this;
    }

    /**
     * Get the value of tv
     */
    public function getTv(): ?Collection
    {
        return $this->tv;
    }

    /**
     * Set the value of tv
     */
    public function setTv(?Collection $tv): self
    {
        $this->tv = $tv;

        return $this;
    }
    public function addTv(TV $tv): static
    {
        if (!$this->tv->contains($tv)){
            $this->tv->add($tv);
            $tv->addActor($this);
        }
        return $this;
    }

    public function removeTv(TV $tv): static
    {
        if ($this->tv->removeElement($tv)) {
            if ($tv->getActors()->contains($this)) {
                $tv->removeActor($this);
            }
        }
        return $this;
    }
}