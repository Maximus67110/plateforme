<?php

namespace App\Entity;

use App\Repository\BoatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoatRepository::class)]
class Boat extends Location
{
    #[ORM\Column(length: 255)]
    private ?string $motor = null;

    #[ORM\Column]
    private ?int $roofHeight = null;

    #[ORM\Column]
    private ?bool $isMoving = null;

    public function getMotor(): ?string
    {
        return $this->motor;
    }

    public function setMotor(string $motor): static
    {
        $this->motor = $motor;

        return $this;
    }

    public function getRoofHeight(): ?int
    {
        return $this->roofHeight;
    }

    public function setRoofHeight(int $roofHeight): static
    {
        $this->roofHeight = $roofHeight;

        return $this;
    }

    public function isIsMoving(): ?bool
    {
        return $this->isMoving;
    }

    public function setIsMoving(bool $isMoving): static
    {
        $this->isMoving = $isMoving;

        return $this;
    }
}
