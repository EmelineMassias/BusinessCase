<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'Veuillez entrer le détail de la commande')]
    private ?string $detail = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Veuillez entrer le prix total de la commande")]
    private ?float $total = null;

    #[ORM\ManyToMany(targetEntity: Vetements::class, inversedBy: 'commandes')]
    #[Assert\NotBlank(message: "Veuillez sélectionner les vêtements qui composent la commande")]
    private Collection $vetements_id;

    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'commandes')]
    #[Assert\NotBlank(message: "Veuillez sélectionner le client qui a passé la commande")]
    private Collection $user_id;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    public function __construct()
    {   
        $this->vetements_id = new ArrayCollection();
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection<int, vetements>
     */
    public function getVetementsId(): Collection
    {
        return $this->vetements_id;
    }

    public function addVetementsId(vetements $vetementsId): static
    {
        if (!$this->vetements_id->contains($vetementsId)) {
            $this->vetements_id->add($vetementsId);
        }

        return $this;
    }

    public function removeVetementsId(vetements $vetementsId): static
    {
        $this->vetements_id->removeElement($vetementsId);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(user $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(user $userId): static
    {
        $this->user_id->removeElement($userId);

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }


}
