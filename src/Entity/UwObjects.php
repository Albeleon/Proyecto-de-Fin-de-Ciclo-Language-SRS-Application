<?php

namespace App\Entity;

use App\Repository\UwObjectsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UwObjectsRepository::class)]
class UwObjects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $object_id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $table;

    #[ORM\Column(type: 'integer')]
    private $original_id;

    #[ORM\Column(type: 'string', length: 36, nullable: true)]
    private $UUID;

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

    public function getTableText(): ?string
    {
        return $this->table_text;
    }

    public function setTableText(?string $table_text): self
    {
        $this->table_text = $table_text;

        return $this;
    }

    public function getOriginalId(): ?int
    {
        return $this->original_id;
    }

    public function setOriginalId(int $original_id): self
    {
        $this->original_id = $original_id;

        return $this;
    }

    public function getUUID(): ?string
    {
        return $this->UUID;
    }

    public function setUUID(?string $UUID): self
    {
        $this->UUID = $UUID;

        return $this;
    }
}
