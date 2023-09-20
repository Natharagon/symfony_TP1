<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

class Theme
{
    private int $id;
    private string $name;
    private Collection $movies;
}