<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 */
class Tags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=RecipeTags::class, mappedBy="tag")
     */
    private $recipeTags;

    public function __construct()
    {
        $this->recipeTags = new ArrayCollection();
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

    /**
     * @return Collection|RecipeTags[]
     */
    public function getRecipeTags(): Collection
    {
        return $this->recipeTags;
    }

    public function addRecipeTags(RecipeTags $recipeTags): self
    {
        if (!$this->recipeTags->contains($recipeTags)) {
            $this->recipeTags[] = $recipeTags;
            $recipeTags->setTag($this);
        }

        return $this;
    }

    public function removeRecipeTags(RecipeTags $recipeTags): self
    {
        if ($this->recipeTags->removeElement($recipeTags)) {
            // set the owning side to null (unless already changed)
            if ($recipeTags->getTag() === $this) {
                $recipeTags->setTag(null);
            }
        }

        return $this;
    }
}
