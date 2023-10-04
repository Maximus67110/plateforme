<?php

namespace App\Entity;

use App\Repository\BoatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BoatRepository::class)]
class Boat extends Location
{
    #[Assert\When(
        expression: 'this.isMoving() === false',
        constraints: [
            new Assert\Blank([], message: 'Motor is not required, the boat is not moving')
        ],
    )]
    #[ORM\Column(length: 255)]
    private ?string $motor = null;

    #[ORM\Column]
    private ?int $roofHeight = null;

    #[Assert\When(
        expression: 'this.getMotor() != null',
        constraints: [
            new Assert\Blank([], message: 'Boat should be moving')
        ],
    )]
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

    public function isMoving(): ?bool
    {
        return $this->isMoving;
    }

    public function setIsMoving(bool $isMoving): static
    {
        $this->isMoving = $isMoving;

        return $this;
    }
}
