<?php

namespace App\Entity;

use App\Repository\UwSyntransRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwSyntransRepository::class)]
class UwSyntrans
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $syntrans_sid;

    #[ORM\Column(type: 'integer')]
    private $defined_meaning_id;

    #[ORM\Column(type: 'integer')]
    private $expression_id;

    #[ORM\Column(type: 'boolean')]
    private $identical_meaning;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSyntransSid(): ?int
    {
        return $this->syntrans_sid;
    }

    public function setSyntransSid(int $syntrans_sid): self
    {
        $this->syntrans_sid = $syntrans_sid;

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

    public function getExpressionId(): ?int
    {
        return $this->expression_id;
    }

    public function setExpressionId(int $expression_id): self
    {
        $this->expression_id = $expression_id;

        return $this;
    }

    public function getIdenticalMeaning(): ?bool
    {
        return $this->identical_meaning;
    }

    public function setIdenticalMeaning(bool $identical_meaning): self
    {
        $this->identical_meaning = $identical_meaning;

        return $this;
    }

    public function getAddTransactionId(): ?int
    {
        return $this->add_transaction_id;
    }

    public function setAddTransactionId(int $add_transaction_id): self
    {
        $this->add_transaction_id = $add_transaction_id;

        return $this;
    }

    public function getRemoveTransactionId(): ?int
    {
        return $this->remove_transaction_id;
    }

    public function setRemoveTransactionId(?int $remove_transaction_id): self
    {
        $this->remove_transaction_id = $remove_transaction_id;

        return $this;
    }
}
