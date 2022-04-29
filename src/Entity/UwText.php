<?php

namespace App\Entity;

use App\Repository\UwTextRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwTextRepository::class)]
class UwText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $text_id;

    #[ORM\Column(type: 'string')]
    private $text_text;

    #[ORM\Column(type: 'blob')]
    private $text_flags;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextId(): ?int
    {
        return $this->text_id;
    }

    public function setTextId(int $text_id): self
    {
        $this->text_id = $text_id;

        return $this;
    }

    public function getTextText()
    {
        return $this->text_text;
    }

    public function setTextText($text_text): self
    {
        $this->text_text = $text_text;

        return $this;
    }

    public function getTextFlags()
    {
        return $this->text_flags;
    }

    public function setTextFlags($text_flags): self
    {
        $this->text_flags = $text_flags;

        return $this;
    }
}
