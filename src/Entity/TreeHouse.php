<?php

namespace App\Entity;

use App\Repository\TreeHouseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreeHouseRepository::class)]
class TreeHouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $treeHeight = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTreeHeight(): ?int
    {
        return $this->treeHeight;
    }

    public function setTreeHeight(int $treeHeight): static
    {
        $this->treeHeight = $treeHeight;

        return $this;
    }
}
