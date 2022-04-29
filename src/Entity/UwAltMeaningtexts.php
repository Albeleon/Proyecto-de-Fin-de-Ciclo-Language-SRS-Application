<?php

namespace App\Entity;

use App\Repository\UwAltMeaningtextsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwAltMeaningtextsRepository::class)]
class UwAltMeaningtexts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $meaning_mid;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $meaning_text_tcid;

    #[ORM\Column(type: 'integer')]
    private $source_id;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeaningMid(): ?int
    {
        return $this->meaning_mid;
    }

    public function setMeaningMid(?int $meaning_mid): self
    {
        $this->meaning_mid = $meaning_mid;

        return $this;
    }

    public function getMeaningTextTcid(): ?int
    {
        return $this->meaning_text_tcid;
    }

    public function setMeaningTextTcid(?int $meaning_text_tcid): self
    {
        $this->meaning_text_tcid = $meaning_text_tcid;

        return $this;
    }

    public function getSourceId(): ?int
    {
        return $this->source_id;
    }

    public function setSourceId(int $source_id): self
    {
        $this->source_id = $source_id;

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
