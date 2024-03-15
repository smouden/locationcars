<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_category = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Recipe::class, orphanRemoval: true)]
    private Collection $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name_category ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->name_category;
    }

    public function setNameCategory(string $name_category): static
    {
        $this->name_category = $name_category;

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): static
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->setCategory($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }

        return $this;
    }
}
