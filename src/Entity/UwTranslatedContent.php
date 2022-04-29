<?php

namespace App\Entity;

use App\Repository\UwTranslatedContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwTranslatedContentRepository::class)]
class UwTranslatedContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $translated_content_id;

    #[ORM\Column(type: 'integer')]
    private $language_id;

    #[ORM\Column(type: 'integer')]
    private $text_id;

    #[ORM\Column(type: 'integer')]
    private $add_transaction_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $remove_transaction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTranslatedContentId(): ?int
    {
        return $this->translated_content_id;
    }

    public function setTranslatedContentId(int $translated_content_id): self
    {
        $this->translated_content_id = $translated_content_id;

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

    public function getTextId(): ?int
    {
        return $this->text_id;
    }

    public function setTextId(int $text_id): self
    {
        $this->text_id = $text_id;

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
