<?php

namespace App\Entity;

use App\Repository\IsFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IsFavouriteRepository::class)]
class IsFavourite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $favourite = null;

    #[ORM\ManyToOne]
    private ?User $userId = null;

    #[ORM\ManyToOne]
    private ?RealEstate $realEstateId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isFavourite(): ?bool
    {
        return $this->favourite;
    }

    public function setFavourite(?bool $favourite): static
    {
        $this->favourite = $favourite;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getRealEstateId(): ?RealEstate
    {
        return $this->realEstateId;
    }

    public function setRealEstateId(?RealEstate $realEstateId): static
    {
        $this->realEstateId = $realEstateId;

        return $this;
    }
}
