<?php

namespace App\Entity;

use App\Repository\TreeHouseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreeHouseRepository::class)]
class TreeHouse extends Location
{
    #[ORM\Column]
    private ?int $treeHeight = null;

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
