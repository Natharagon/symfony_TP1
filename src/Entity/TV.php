<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
class TV
{
    private int $id;
    private ?string $name;
    private ?Collection $images;
    private ?Collection $videos;
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
    private ?Collection $themes;
    private ?Collection $reviews;
    private ?Collection $actors;

    # Functions
    public function __construct()
    {
        $this->themes = new ArrayCollection();
        $this->actors = new ArrayCollection();
        $this->reviews = new ArrayCollection();
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
     * Get the value of images
     */
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * Set the value of images
     */
    public function setImages(?Collection $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get the value of videos
     */
    public function getVideos(): ?Collection
    {
        return $this->videos;
    }

    /**
     * Set the value of videos
     */
    public function setVideos(?Collection $videos): self
    {
        $this->videos = $videos;

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

    public function addTheme(Theme $theme): static
    {
        if (!$this->themes->contains($theme)){
            $this->themes->add($theme);
            $theme->addTv($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): static
    {
        if ($this->themes->removeElement($theme)) {
            if ($theme->getTv()->contains($this)) {
                $theme->removeTv($this);
            }
        }
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

    /**
     * Get the value of actors
     */
    public function getActors(): ?Collection
    {
        return $this->actors;
    }

    /**
     * Set the value of actors
     */
    public function setActors(?Collection $actors): self
    {
        $this->actors = $actors;

        return $this;
    }
}