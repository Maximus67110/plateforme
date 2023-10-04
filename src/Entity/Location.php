<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ReflectionClass;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: 'locationType', type: 'string')]
#[ORM\DiscriminatorMap(['appart' => Appart::class, 'boat' => Boat::class, 'house' => House::class, 'treeHouse' => TreeHouse::class])]
#[ORM\Entity(repositoryClass: LocationRepository::class)]
abstract class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[Assert\NotBlank([], '{{ label }} should not be blank.')]
    #[ORM\Column(length: 255)]
    protected ?string $address = null;

    #[ORM\Column]
    protected ?int $nbrRoom = null;

    #[ORM\Column(type: Types::TEXT)]
    protected ?string $description = null;

    #[Assert\Positive([], '{{ label }} should be positive')]
    #[ORM\Column]
    protected ?int $nightPrice = null;

    #[ORM\Column]
    protected ?int $area = null;

    #[ORM\Column(length: 255)]
    protected ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Room::class)]
    protected Collection $room;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    protected ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Booking::class)]
    protected Collection $booking;

    #[Assert\Length(
        min: 10,
        max: 100,
        minMessage: '{{ label }} must be at least {{ limit }} characters long',
        maxMessage: '{{ label }} cannot be longer than {{ limit }} characters',
    )]
    #[ORM\Column(length: 255)]
    protected ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $latitude = null;

    #[ORM\Column(length: 255)]
    private ?string $longitude = null;

    public function __construct()
    {
        $this->room = new ArrayCollection();
        $this->booking = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getNbrRoom(): ?int
    {
        return $this->nbrRoom;
    }

    public function setNbrRoom(int $nbrRoom): static
    {
        $this->nbrRoom = $nbrRoom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNightPrice(): ?int
    {
        return $this->nightPrice;
    }

    public function setNightPrice(int $nightPrice): static
    {
        $this->nightPrice = $nightPrice;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(int $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->room->contains($room)) {
            $this->room->add($room);
            $room->setLocation($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->room->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getLocation() === $this) {
                $room->setLocation(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBooking(): Collection
    {
        return $this->booking;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->booking->contains($booking)) {
            $this->booking->add($booking);
            $booking->setLocation($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->booking->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getLocation() === $this) {
                $booking->setLocation(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getClassName(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }
}
