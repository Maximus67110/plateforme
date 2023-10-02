<?php

namespace App\Entity;

use App\Repository\HouseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HouseRepository::class)]
class House extends Location
{
    #[ORM\Column]
    private ?bool $garage = null;

    #[ORM\Column]
    private ?bool $pool = null;

    public function isGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(bool $garage): static
    {
        $this->garage = $garage;

        return $this;
    }

    public function isPool(): ?bool
    {
        return $this->pool;
    }

    public function setPool(bool $pool): static
    {
        $this->pool = $pool;

        return $this;
    }
}
