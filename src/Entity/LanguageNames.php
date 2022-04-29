<?php

namespace App\Entity;

use App\Repository\LanguageNamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageNamesRepository::class)]
class LanguageNames
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $language_id;

    #[ORM\Column(type: 'integer')]
    private $name_language_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $language_name;

    #[ORM\OneToMany(mappedBy: 'idiomaNativo', targetEntity: SRS::class)]
    private $SRSNativos;

    #[ORM\OneToMany(mappedBy: 'idiomaObjetivo', targetEntity: SRS::class)]
    private $SRSObjetivos;

    public function __construct()
    {
        $this->SRSs = new ArrayCollection();
        $this->SRSObjetivos = new ArrayCollection();
    }

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

    public function getNameLanguageId(): ?int
    {
        return $this->name_language_id;
    }

    public function setNameLanguageId(int $name_language_id): self
    {
        $this->name_language_id = $name_language_id;

        return $this;
    }

    public function getLanguageName(): ?string
    {
        return $this->language_name;
    }

    public function setLanguageName(?string $language_name): self
    {
        $this->language_name = $language_name;

        return $this;
    }

    /**
     * @return Collection<int, SRS>
     */
    public function getSRSNativos(): Collection
    {
        return $this->SRSNativos;
    }

    public function addSRSNativos(SRS $sRSNativos): self
    {
        if (!$this->SRSNativos->contains($sRSNativos)) {
            $this->SRSNativos[] = $sRSNativos;
            $sRSNativos->setIdiomaNativo($this);
        }

        return $this;
    }

    public function removeSRSNativos(SRS $sRSNativos): self
    {
        if ($this->SRSNativos->removeElement($sRSNativos)) {
            // set the owning side to null (unless already changed)
            if ($sRSNativos->getIdiomaNativo() === $this) {
                $sRSNativos->setIdiomaNativo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SRS>
     */
    public function getSRSObjetivos(): Collection
    {
        return $this->SRSObjetivos;
    }

    public function addSRSObjetivo(SRS $sRSObjetivo): self
    {
        if (!$this->SRSObjetivos->contains($sRSObjetivo)) {
            $this->SRSObjetivos[] = $sRSObjetivo;
            $sRSObjetivo->setIdiomaObjetivo($this);
        }

        return $this;
    }

    public function removeSRSObjetivo(SRS $sRSObjetivo): self
    {
        if ($this->SRSObjetivos->removeElement($sRSObjetivo)) {
            // set the owning side to null (unless already changed)
            if ($sRSObjetivo->getIdiomaObjetivo() === $this) {
                $sRSObjetivo->setIdiomaObjetivo(null);
            }
        }

        return $this;
    }
}
