<?php

namespace Alura\Doctrine\Entity;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Student
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    public readonly int $id;
    public readonly string $name;

    public function __construct(#[Column] string $name)
    {
        $this->name = $name;
    }
}
