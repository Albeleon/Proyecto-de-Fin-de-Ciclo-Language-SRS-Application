<?php

namespace App\Entity;

use App\Repository\UwCollectionContentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwCollectionContentsRepository::class)]
class UwCollectionContents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $object_id;

    #[ORM\Column(type: 'integer')]
    private $collection_id;

    #[ORM\Column(type: 'integer')]
    private $member_mid;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $internal_member_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $applicable_language_id;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjectId(): ?int
    {
        return $this->object_id;
    }

    public function setObjectId(?int $object_id): self
    {
        $this->object_id = $object_id;

        return $this;
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

    public function getMemberMid(): ?int
    {
        return $this->member_mid;
    }

    public function setMemberMid(int $member_mid): self
    {
        $this->member_mid = $member_mid;

        return $this;
    }

    public function getInternalMemberId(): ?string
    {
        return $this->internal_member_id;
    }

    public function setInternalMemberId(?string $internal_member_id): self
    {
        $this->internal_member_id = $internal_member_id;

        return $this;
    }

    public function getApplicableLanguageId(): ?int
    {
        return $this->applicable_language_id;
    }

    public function setApplicableLanguageId(?int $applicable_language_id): self
    {
        $this->applicable_language_id = $applicable_language_id;

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
