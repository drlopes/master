<?php

namespace Alura\Doctrine\Entity;
use Doctrine\ORM\Mapping\{Entity, Column, GeneratedValue, Id, ManyToMany};
use Doctrine\Common\Collections\{ArrayCollection, Collection};

#[Entity]
class Course
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[ManyToMany(targetEntity: Student::class, mappedBy: "courses")]
    private Collection $students;

    function __construct(
        #[Column]
        public readonly string $name
        ) {
            $this->students = new ArrayCollection();
    }

    public function students(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        if ($this->students->contains($student)) {
            return;
        }
        $this->students->add($student);
    }
}
