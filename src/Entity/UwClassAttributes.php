<?php

namespace App\Entity;

use App\Repository\UwClassAttributesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwClassAttributesRepository::class)]
class UwClassAttributes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $object_id;

    #[ORM\Column(type: 'integer')]
    private $class_mid;

    #[ORM\Column(type: 'integer')]
    private $level_mid;

    #[ORM\Column(type: 'integer')]
    private $attribute_mid;

    #[ORM\Column(type: 'string', length: 4)]
    private $attribute_type;

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

    public function setObjectId(int $object_id): self
    {
        $this->object_id = $object_id;

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

    public function getLevelMid(): ?int
    {
        return $this->level_mid;
    }

    public function setLevelMid(int $level_mid): self
    {
        $this->level_mid = $level_mid;

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

    public function getAttributeType(): ?string
    {
        return $this->attribute_type;
    }

    public function setAttributeType(string $attribute_type): self
    {
        $this->attribute_type = $attribute_type;

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
