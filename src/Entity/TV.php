<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
class TV
{
    private int $id;
    private ?string $name;
    private Collection $images;
    private Collection $videos;
    private ?string $language;
    private ?string $country;
    private ?string $overview;
    private ?int $seasons;
    private ?int $episodes;
    private ?float $grade;
    private ?string $director;
    private ?DateTime $startDate;
    private ?int $status;
    private Collection $themes;
    private Collection $reviews;
    private Collection $actors;

    # Functions
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->themes = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->actors = new ArrayCollection();
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

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)){
            $this->images->add($image);
            $image->setTv($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getTv() === $this) {
                $image->setTv(null);
            }
        }
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

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)){
            $this->videos->add($video);
            $video->setTv($this);
        }
        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            if ($video->getTv() === $this) {
                $video->setTv(null);
            }
        }
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
     * Get the value of overview
     */
    public function getOverview(): ?string
    {
        return $this->overview;
    }

    /**
     * Set the value of overview
     */
    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;

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

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)){
            $this->reviews->add($review);
            $review->setTv($this);
        }
        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            if ($review->getTv()===$this) {
                $review->setTv(null);
            }
        }
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

    public function addActor(Actor $actor): static
    {
        if (!$this->actors->contains($actor)){
            $this->actors->add($actor);
            $actor->addTv($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            if ($actor->getTv()->contains($this)) {
                $actor->removeTv($this);
            }
        }
        return $this;
    }
}