<?php

namespace App\Entity;

use App\Repository\ConditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConditionRepository::class)]
class Condition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $levelRequired = null;

    // HDV
    #[ORM\ManyToOne (cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false), ]
    private ?Building $building = null;

    // Caserne
    #[ORM\ManyToOne(inversedBy: 'conditions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Building $linkedBuilding = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevelRequired(): ?int
    {
        return $this->levelRequired;
    }

    public function setLevelRequired(int $levelRequired): static
    {
        $this->levelRequired = $levelRequired;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): static
    {
        $this->building = $building;

        return $this;
    }

    public function getLinkedBuilding(): ?Building
    {
        return $this->linkedBuilding;
    }

    public function setLinkedBuilding(?Building $linkedBuilding): static
    {
        $this->linkedBuilding = $linkedBuilding;

        return $this;
    }
}
