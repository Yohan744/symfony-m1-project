<?php

namespace App\Entity;

use App\Repository\BuildingStateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingStateRepository::class)]
class BuildingState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $upgradeReward = null;

    #[ORM\Column]
    private ?int $upgradeCost = null;

    #[ORM\ManyToOne(inversedBy: 'buildingStates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Building $building = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getUpgradeReward(): ?int
    {
        return $this->upgradeReward;
    }

    public function setUpgradeReward(int $upgradeReward): static
    {
        $this->upgradeReward = $upgradeReward;

        return $this;
    }

    public function getUpgradeCost(): ?int
    {
        return $this->upgradeCost;
    }

    public function setUpgradeCost(int $upgradeCost): static
    {
        $this->upgradeCost = $upgradeCost;

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
}
