<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientsRepository::class)
 */
class Ingredients
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
     * @ORM\ManyToOne(targetEntity=IngredientCategories::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredientCategory;

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

    public function getIngredientCategory(): ?IngredientCategories
    {
        return $this->ingredientCategory;
    }

    public function setIngredientCategory(?IngredientCategories $ingredientCategory): self
    {
        $this->ingredientCategory = $ingredientCategory;

        return $this;
    }
}
