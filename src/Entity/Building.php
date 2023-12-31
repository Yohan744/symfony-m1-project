<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use App\Repository\BuildingStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingRepository::class)]
class Building
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: BuildingState::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $buildingStates;

    #[ORM\OneToMany(mappedBy: 'linkedBuilding', targetEntity: Condition::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $conditions;

    #[ORM\Column]
    private ?int $level = 0;

    public ?BuildingState $currentState;

    public function __construct()
    {
        $this->buildingStates = new ArrayCollection();
        $this->conditions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, BuildingState>
     */
    public function getBuildingStates(): Collection
    {
        return $this->buildingStates;
    }
    public function getCurrentBuildingState(BuildingStateRepository $repository): static
    {

        $this->currentState = $repository->findOneByLevel($this->id, $this->level);
        return $this;
    }

    public function addBuildingState(BuildingState $buildingState): static
    {
        if (!$this->buildingStates->contains($buildingState)) {
            $this->buildingStates->add($buildingState);
            $buildingState->setBuilding($this);
        }

        return $this;
    }

    public function removeBuildingState(BuildingState $buildingState): static
    {
        if ($this->buildingStates->removeElement($buildingState)) {
            // set the owning side to null (unless already changed)
            if ($buildingState->getBuilding() === $this) {
                $buildingState->setBuilding(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Condition>
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(Condition $condition): static
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions->add($condition);
            $condition->setLinkedBuilding($this);
        }

        return $this;
    }

    public function removeCondition(Condition $condition): static
    {
        if ($this->conditions->removeElement($condition)) {
            // set the owning side to null (unless already changed)
            if ($condition->getLinkedBuilding() === $this) {
                $condition->setLinkedBuilding(null);
            }
        }

        return $this;
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
    public function increaseLevel()
    {
        $this->level = $this->level + 1;
        return $this;
    }
}
