<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
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
    private ?Collection $reviews;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of language
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * Set the value of language
     */
    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Set the value of country
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of seasons
     */
    public function getSeasons(): ?int
    {
        return $this->seasons;
    }

    /**
     * Set the value of seasons
     */
    public function setSeasons(?int $seasons): self
    {
        $this->seasons = $seasons;

        return $this;
    }

    /**
     * Get the value of episodes
     */
    public function getEpisodes(): ?int
    {
        return $this->episodes;
    }

    /**
     * Set the value of episodes
     */
    public function setEpisodes(?int $episodes): self
    {
        $this->episodes = $episodes;

        return $this;
    }

    /**
     * Get the value of grades
     */
    public function getGrades(): ?int
    {
        return $this->grades;
    }

    /**
     * Set the value of grades
     */
    public function setGrades(?int $grades): self
    {
        $this->grades = $grades;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of director
     */
    public function getDirector(): ?string
    {
        return $this->director;
    }

    /**
     * Set the value of director
     */
    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get the value of startDate
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     */
    public function setStartDate(?DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of isAdult
     */
    public function isIsAdult(): ?bool
    {
        return $this->isAdult;
    }

    /**
     * Set the value of isAdult
     */
    public function setIsAdult(?bool $isAdult): self
    {
        $this->isAdult = $isAdult;

        return $this;
    }

    /**
     * Get the value of reviews
     */
    public function getReviews(): ?Collection
    {
        return $this->reviews;
    }

    /**
     * Set the value of reviews
     */
    public function setReviews(?Collection $reviews): self
    {
        $this->reviews = $reviews;

        return $this;
    }
}