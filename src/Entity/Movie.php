<?php

namespace App\Entity;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
class Movie 
{
    # Attributes
    private int $id;
    private ?string $title;
    private Collection $images;
    private Collection $videos;
    private ?string $synopsis;
    private ?string $language;
    private ?bool $isAdult;
    private ?DateTime $releaseDate;
    private ?float $grade;
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
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * Set the value of image
     */
    public function setImages(?Collection $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)){
            $this->images->add($image);
            $image->setMovie($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getMovie() === $this) {
                $image->setMovie(null);
            }
        }
        return $this;
    }

    /**
     * Get the value of video
     */
    public function getVideo(): ?Collection
    {
        return $this->videos;
    }

    /**
     * Set the value of video
     */
    public function setVideo(?Collection $video): self
    {
        $this->videos = $video;

        return $this;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)){
            $this->videos->add($video);
            $video->setMovie($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            if ($video->getMovie() === $this) {
                $video->setMovie(null);
            }
        }
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

    public function addTheme(Theme $theme): static
    {
        if (!$this->themes->contains($theme)){
            $this->themes->add($theme);
            $theme->addMovie($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): static
    {
        if ($this->themes->removeElement($theme)) {
            if ($theme->getMovies()->contains($this)) {
                $theme->removeMovie($this);
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
            $review->setMovie($this);
        }
        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            if ($review->getMovie()===$this) {
                $review->setMovie(null);
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
            $actor->addMovie($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            if ($actor->getMovies()->contains($this)) {
                $actor->removeMovie($this);
            }
        }
        return $this;
    }
}