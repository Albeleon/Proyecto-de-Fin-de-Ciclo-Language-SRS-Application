<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $language_id;

    #[ORM\Column(type: 'integer')]
    private $dialect_of_lid;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $iso639_2;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $iso639_3;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $wikimedia_key;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id): self
    {
        $this->language_id = $language_id;

        return $this;
    }

    public function getDialectOfLid(): ?int
    {
        return $this->dialect_of_lid;
    }

    public function setDialectOfLid(int $dialect_of_lid): self
    {
        $this->dialect_of_lid = $dialect_of_lid;

        return $this;
    }

    public function getIso6392(): ?string
    {
        return $this->iso639_2;
    }

    public function setIso6392(?string $iso639_2): self
    {
        $this->iso639_2 = $iso639_2;

        return $this;
    }

    public function getIso6393(): ?string
    {
        return $this->iso639_3;
    }

    public function setIso6393(?string $iso639_3): self
    {
        $this->iso639_3 = $iso639_3;

        return $this;
    }

    public function getWikimediaKey(): ?string
    {
        return $this->wikimedia_key;
    }

    public function setWikimediaKey(?string $wikimedia_key): self
    {
        $this->wikimedia_key = $wikimedia_key;

        return $this;
    }
}
