<?php

namespace App\Entity;

use App\Repository\UwTextAttributeValuesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwTextAttributeValuesRepository::class)]
class UwTextAttributeValues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $value_id;

    #[ORM\Column(type: 'integer')]
    private $object_id;

    #[ORM\Column(type: 'integer')]
    private $attribute_mid;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $text;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueId(): ?int
    {
        return $this->value_id;
    }

    public function setValueId(int $value_id): self
    {
        $this->value_id = $value_id;

        return $this;
    }

    public function getObjectId(): ?int
    {
        return $this->object_id;
    }

    public function setObjectId(int $object_id): self
    {
        $this->object_id = $object_id;

        return $this;
    }

    public function getAttributeMid(): ?int
    {
        return $this->attribute_mid;
    }

    public function setAttributeMid(int $attribute_mid): self
    {
        $this->attribute_mid = $attribute_mid;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): self
    {
        $this->text = $text;

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
