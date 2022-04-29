<?php

namespace App\Entity;

use App\Repository\SRSRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SRSRepository::class)]
class SRS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 40)]
    private $nombre;

    #[ORM\Column(type: 'datetime')]
    private $fecha;

    #[ORM\ManyToOne(targetEntity: LanguageNames::class, inversedBy: 'SRSNativos')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'language_id')]
    private $idiomaNativo;

    #[ORM\ManyToOne(targetEntity: LanguageNames::class, inversedBy: 'SRSObjetivos')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'language_id')]
    private $IdiomaObjetivo;

    #[ORM\OneToMany(mappedBy: 'SRS', targetEntity: SRSVocabulary::class)]
    private $SRSVocabularies;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'SRS')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    public function __construct()
    {
        $this->idiomaNativo = new ArrayCollection();
        $this->SRSVocabularies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getIdiomaNativo(): ?LanguageNames
    {
        return $this->idiomaNativo;
    }

    public function setIdiomaNativo(?LanguageNames $idiomaNativo): self
    {
        $this->idiomaNativo = $idiomaNativo;

        return $this;
    }

    public function getIdiomaObjetivo(): ?LanguageNames
    {
        return $this->IdiomaObjetivo;
    }

    public function setIdiomaObjetivo(?LanguageNames $IdiomaObjetivo): self
    {
        $this->IdiomaObjetivo = $IdiomaObjetivo;

        return $this;
    }

    /**
     * @return Collection<int, SRSVocabulary>
     */
    public function getSRSVocabularies(): Collection
    {
        return $this->SRSVocabularies;
    }

    public function addSRSVocabulary(SRSVocabulary $sRSVocabulary): self
    {
        if (!$this->SRSVocabularies->contains($sRSVocabulary)) {
            $this->SRSVocabularies[] = $sRSVocabulary;
            $sRSVocabulary->setSRS($this);
        }

        return $this;
    }

    public function removeSRSVocabulary(SRSVocabulary $sRSVocabulary): self
    {
        if ($this->SRSVocabularies->removeElement($sRSVocabulary)) {
            // set the owning side to null (unless already changed)
            if ($sRSVocabulary->getSRS() === $this) {
                $sRSVocabulary->setSRS(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

}
