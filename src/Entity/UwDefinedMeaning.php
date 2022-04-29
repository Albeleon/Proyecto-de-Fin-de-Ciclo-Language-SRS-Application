<?php

namespace App\Entity;

use App\Repository\UwDefinedMeaningRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwDefinedMeaningRepository::class)]
class UwDefinedMeaning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $defined_meaning_id;

    #[ORM\Column(type: 'integer')]
    private $expression_id;

    #[ORM\Column(type: 'integer')]
    private $meaning_text_tcid;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMeaningTextTcid(): ?int
    {
        return $this->meaning_text_tcid;
    }

    public function setMeaningTextTcid(int $meaning_text_tcid): self
    {
        $this->meaning_text_tcid = $meaning_text_tcid;

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
