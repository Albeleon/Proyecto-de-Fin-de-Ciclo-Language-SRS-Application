<?php

namespace App\Entity;

use App\Repository\SRSVocabularyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SRSVocabularyRepository::class)]
class SRSVocabulary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 1023)]
    private $palabrasObjetivo;

    #[ORM\Column(type: 'string', length: 1023)]
    private $palabrasOrigen;

    #[ORM\Column(type: 'string')]
    private $descripcion;

    #[ORM\Column(type: 'integer')]
    private $nivel;

    #[ORM\Column(type: 'datetime')]
    private $fechaProxima;

    #[ORM\Column(type: 'boolean')]
    private $fallada;

    #[ORM\ManyToOne(targetEntity: SRS::class, inversedBy: 'SRSVocabularies')]
    #[ORM\JoinColumn(nullable: false)]
    private $SRS;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPalabrasObjetivo(): ?string
    {
        return $this->palabrasObjetivo;
    }

    public function setPalabrasObjetivo(string $palabrasObjetivo): self
    {
        $this->palabrasObjetivo = $palabrasObjetivo;

        return $this;
    }

    public function getPalabrasOrigen(): ?string
    {
        return $this->palabrasOrigen;
    }

    public function setPalabrasOrigen(string $palabrasOrigen): self
    {
        $this->palabrasOrigen = $palabrasOrigen;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(int $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getFechaProxima(): ?\DateTimeInterface
    {
        return $this->fechaProxima;
    }

    public function setFechaProxima(\DateTimeInterface $fechaProxima): self
    {
        $this->fechaProxima = $fechaProxima;

        return $this;
    }

    public function getFallada(): ?bool
    {
        return $this->fallada;
    }

    public function setFallada(bool $fallada): self
    {
        $this->fallada = $fallada;

        return $this;
    }

    public function getSRS(): ?SRS
    {
        return $this->SRS;
    }

    public function setSRS(?SRS $SRS): self
    {
        $this->SRS = $SRS;

        return $this;
    }
}
