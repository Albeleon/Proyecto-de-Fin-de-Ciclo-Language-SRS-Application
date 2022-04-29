<?php

namespace App\Entity;

use App\Repository\UwCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwCollectionRepository::class)]
class UwCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $collection_id;

    #[ORM\Column(type: 'integer')]
    private $collection_mid;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private $collection_type;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollectionId(): ?int
    {
        return $this->collection_id;
    }

    public function setCollectionId(int $collection_id): self
    {
        $this->collection_id = $collection_id;

        return $this;
    }

    public function getCollectionMid(): ?int
    {
        return $this->collection_mid;
    }

    public function setCollectionMid(int $collection_mid): self
    {
        $this->collection_mid = $collection_mid;

        return $this;
    }

    public function getCollectionType(): ?string
    {
        return $this->collection_type;
    }

    public function setCollectionType(?string $collection_type): self
    {
        $this->collection_type = $collection_type;

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
