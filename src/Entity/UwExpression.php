<?php

namespace App\Entity;

use App\Repository\UwExpressionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwExpressionRepository::class)]
class UwExpression
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $expression_id;

    #[ORM\Column(type: 'string', nullable: true)]
    private $spelling;

    #[ORM\Column(type: 'integer')]
    private $language_id;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSpelling()
    {
        return $this->spelling;
    }

    public function setSpelling($spelling): self
    {
        $this->spelling = $spelling;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id): self
    {
        $this->language_id = $language_id;

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
