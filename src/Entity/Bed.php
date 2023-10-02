<?php

namespace App\Entity;

use App\Repository\BedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BedRepository::class)]
class Bed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'bed', targetEntity: RoomDetail::class)]
    private Collection $roomDetails;

    public function __construct()
    {
        $this->roomDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, RoomDetail>
     */
    public function getRoomDetails(): Collection
    {
        return $this->roomDetails;
    }

    public function addRoomDetail(RoomDetail $roomDetail): static
    {
        if (!$this->roomDetails->contains($roomDetail)) {
            $this->roomDetails->add($roomDetail);
            $roomDetail->setBed($this);
        }

        return $this;
    }

    public function removeRoomDetail(RoomDetail $roomDetail): static
    {
        if ($this->roomDetails->removeElement($roomDetail)) {
            // set the owning side to null (unless already changed)
            if ($roomDetail->getBed() === $this) {
                $roomDetail->setBed(null);
            }
        }

        return $this;
    }
}
