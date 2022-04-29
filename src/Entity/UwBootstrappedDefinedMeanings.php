<?php

namespace App\Entity;

use App\Repository\UwBootstrappedDefinedMeaningsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwBootstrappedDefinedMeaningsRepository::class)]
class UwBootstrappedDefinedMeanings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $defined_meaning_id;

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

    public function getDefinedMeaningId(): ?int
    {
        return $this->defined_meaning_id;
    }

    public function setDefinedMeaningId(int $defined_meaning_id): self
    {
        $this->defined_meaning_id = $defined_meaning_id;

        return $this;
    }
}
