<?php

namespace App\Entity;

class Actor
{
    private int $id;
    private ?string $lastName;
    private ?string $firstName;
    private ?int $gender;
    private ?string $biography;

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
}