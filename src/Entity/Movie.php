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
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?Collection
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?Collection $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of video
     */
    public function getVideo(): ?Collection
    {
        return $this->video;
    }

    /**
     * Set the value of video
     */
    public function setVideo(?Collection $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get the value of synopsis
     */
    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    /**
     * Set the value of synopsis
     */
    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

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
     * Get the value of releaseDate
     */
    public function getReleaseDate(): ?DateTime
    {
        return $this->releaseDate;
    }

    /**
     * Set the value of releaseDate
     */
    public function setReleaseDate(?DateTime $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get the value of grade
     */
    public function getGrade(): ?float
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     */
    public function setGrade(?float $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get the value of themes
     */
    public function getThemes(): ?Collection
    {
        return $this->themes;
    }

    /**
     * Set the value of themes
     */
    public function setThemes(?Collection $themes): self
    {
        $this->themes = $themes;

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