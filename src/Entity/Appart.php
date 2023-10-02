<?php

namespace App\Entity;

use App\Repository\AppartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartRepository::class)]
class Appart extends Location
{
    #[ORM\Column]
    private ?int $floor = null;

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): static
    {
        $this->floor = $floor;

        return $this;
    }
}
