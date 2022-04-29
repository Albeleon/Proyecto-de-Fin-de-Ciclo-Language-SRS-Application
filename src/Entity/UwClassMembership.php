<?php

namespace App\Entity;

use App\Repository\UwClassMembershipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwClassMembershipRepository::class)]
class UwClassMembership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $class_membership_id;

    #[ORM\Column(type: 'integer')]
    private $class_mid;

    #[ORM\Column(type: 'integer')]
    private $class_member_mid;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassMembershipId(): ?int
    {
        return $this->class_membership_id;
    }

    public function setClassMembershipId(int $class_membership_id): self
    {
        $this->class_membership_id = $class_membership_id;

        return $this;
    }

    public function getClassMid(): ?int
    {
        return $this->class_mid;
    }

    public function setClassMid(int $class_mid): self
    {
        $this->class_mid = $class_mid;

        return $this;
    }

    public function getClassMemberMid(): ?int
    {
        return $this->class_member_mid;
    }

    public function setClassMemberMid(int $class_member_mid): self
    {
        $this->class_member_mid = $class_member_mid;

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
