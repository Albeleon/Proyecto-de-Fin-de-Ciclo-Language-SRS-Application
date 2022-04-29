<?php

namespace App\Entity;

use App\Repository\UwMeaningRelationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwMeaningRelationsRepository::class)]
class UwMeaningRelations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $relation_id;

    #[ORM\Column(type: 'integer')]
    private $meaning1_mid;

    #[ORM\Column(type: 'integer')]
    private $meaning2_mid;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $relationtype_mid;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelationId(): ?int
    {
        return $this->relation_id;
    }

    public function setRelationId(int $relation_id): self
    {
        $this->relation_id = $relation_id;

        return $this;
    }

    public function getMeaning1Mid(): ?int
    {
        return $this->meaning1_mid;
    }

    public function setMeaning1Mid(int $meaning1_mid): self
    {
        $this->meaning1_mid = $meaning1_mid;

        return $this;
    }

    public function getMeaning2Mid(): ?int
    {
        return $this->meaning2_mid;
    }

    public function setMeaning2Mid(int $meaning2_mid): self
    {
        $this->meaning2_mid = $meaning2_mid;

        return $this;
    }

    public function getRelationtypeMid(): ?int
    {
        return $this->relationtype_mid;
    }

    public function setRelationtypeMid(?int $relationtype_mid): self
    {
        $this->relationtype_mid = $relationtype_mid;

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
