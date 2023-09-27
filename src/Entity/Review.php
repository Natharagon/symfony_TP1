<?php

namespace App\Entity;
class Review
{
    private int $id;
    private ?int $grade;
    private ?string $comment;
    private ?string $username;

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
     * Get the value of grade
     */
    public function getGrade(): ?int
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     */
    public function setGrade(?int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }
}