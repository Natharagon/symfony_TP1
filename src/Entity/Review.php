<?php

namespace App\Entity;
class Review
{
    private int $id;
    private ?int $grade;
    private ?string $comment;
    private ?string $username;
}