<?php

namespace Alura\CRUD\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\{Entity, Column, GeneratedValue, Id, Table};

#[Entity]
#[Table(name: 'course')]
class Course implements \JsonSerializable
{
    #[Id, GeneratedValue, Column(type: Types::INTEGER)]
    private $id;

    #[Column(type: Types::STRING)]
    private $description;

    public function id(): int
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'description' => $this->description
        ];
    }
}
