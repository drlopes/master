<?php

namespace Alura\Doctrine\Entity;
use Doctrine\ORM\Mapping\{Entity, Column, GeneratedValue, Id, ManyToOne};

#[Entity]
class Phone
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[ManyToOne(targetEntity: Student::class, inversedBy: "phones")]
    public readonly Student $student;

    function __construct(
        #[Column]
        public readonly string $number
        ) {
    }

    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }
}
