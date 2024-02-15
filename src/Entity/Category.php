<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez entrer le libellé de la Catégorie")]
    private ?string $libelle = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categoryChilds')]
    private ?self $categoryParent = null;

    #[ORM\OneToMany(mappedBy: 'categoryParent', targetEntity: self::class)]
    private Collection $categoryChilds;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Vetements::class, orphanRemoval: true)]
    private Collection $vetements;

    public function __construct()
    {
        $this->categoryChilds = new ArrayCollection();
        $this->vetements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCategoryParent(): ?self
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(?self $categoryParent): static
    {
        $this->categoryParent = $categoryParent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategoryChilds(): Collection
    {
        return $this->categoryChilds;
    }

    public function addCategoryChild(self $categoryChild): static
    {
        if (!$this->categoryChilds->contains($categoryChild)) {
            $this->categoryChilds->add($categoryChild);
            $categoryChild->setCategoryParent($this);
        }

        return $this;
    }

    public function removeCategoryChild(self $categoryChild): static
    {
        if ($this->categoryChilds->removeElement($categoryChild)) {
            // set the owning side to null (unless already changed)
            if ($categoryChild->getCategoryParent() === $this) {
                $categoryChild->setCategoryParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vetements>
     */
    public function getVetements(): Collection
    {
        return $this->vetements;
    }

    public function addVetement(Vetements $vetement): static
    {
        if (!$this->vetements->contains($vetement)) {
            $this->vetements->add($vetement);
            $vetement->setCategory($this);
        }

        return $this;
    }

    public function removeVetement(Vetements $vetement): static
    {
        if ($this->vetements->removeElement($vetement)) {
            // set the owning side to null (unless already changed)
            if ($vetement->getCategory() === $this) {
                $vetement->setCategory(null);
            }
        }

        return $this;
    }
}
