<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 */
class Recipes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Yields::class)
     */
    private $yield;

    /**
     * @ORM\OneToMany(targetEntity=RecipeTags::class, mappedBy="recipe")
     */
    private $recipeTags;

    /**
     * @ORM\OneToMany(targetEntity=RecipeIngredients::class, mappedBy="recipe")
     */
    private $recipeIngredients;

    public function __construct()
    {
        $this->recipeTags = new ArrayCollection();
        $this->recipeIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(?int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getYield(): ?Yields
    {
        return $this->yield;
    }

    public function setYield(?Yields $yield): self
    {
        $this->yield = $yield;

        return $this;
    }

    /**
     * @return Collection|RecipeTags[]
     */
    public function getRecipeTags(): Collection
    {
        return $this->recipeTags;
    }

    public function addRecipeTag(RecipeTags $recipeTag): self
    {
        if (!$this->recipeTags->contains($recipeTag)) {
            $this->recipeTags[] = $recipeTag;
            $recipeTag->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeTag(RecipeTags $recipeTag): self
    {
        if ($this->recipeTags->removeElement($recipeTag)) {
            // set the owning side to null (unless already changed)
            if ($recipeTag->getRecipe() === $this) {
                $recipeTag->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecipeIngredients[]
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredients $recipeIngredient): self
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients[] = $recipeIngredient;
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredients $recipeIngredient): self
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

}
