<?php

namespace App\Entity;

class Image
{
    private int $id;
    private string $path;
    private ?Movie $movie;
    private ?TV $tv;
    
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
     * Get the value of path
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of movie
     */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     */
    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of tv
     */
    public function getTv(): ?TV
    {
        return $this->tv;
    }

    /**
     * Set the value of tv
     */
    public function setTv(?TV $tv): self
    {
        $this->tv = $tv;

        return $this;
    }
}