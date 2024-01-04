<?php

namespace App\Entity;

use App\Repository\RelevesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelevesRepository::class)]
class Releves
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 20)]
    private ?string $brut = null;

    #[ORM\ManyToOne(inversedBy: 'releves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lieu $lieu_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getBrut(): ?string
    {
        return $this->brut;
    }

    public function setBrut(string $brut): static
    {
        $this->brut = $brut;

        return $this;
    }

    public function getLieuId(): ?Lieu
    {
        return $this->lieu_id;
    }

    public function setLieuId(?Lieu $lieu_id): static
    {
        $this->lieu_id = $lieu_id;

        return $this;
    }

}
