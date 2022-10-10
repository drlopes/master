<?php

namespace Alura\Doctrine\Entity;
use Doctrine\ORM\Mapping\{Entity, Column, GeneratedValue, Id, OneToMany, ManyToMany};
use Doctrine\Common\Collections\{ArrayCollection, Collection};

#[Entity]
class Student
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToMany(targetEntity: Phone::class, mappedBy: "student", cascade: ["persist", "remove"])]
    private Collection $phones;

    #[ManyToMany(targetEntity: Course::class, inversedBy: "students")]
    private Collection $courses;

    public function __construct(
      #[Column]
      public readonly string $name
    ) {
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function addPhone(Phone $phone)
    {
        $this->phones->add($phone);
        $phone->setStudent($this);
    }

    public function phones(): Collection
    {
        return $this->phones;
    }

    public function courses(): Collection
    {
        return $this->courses;
    }

    public function enrollInCourse(Course $course): void
    {
        if ($this->courses->contains($course)) {
            return;
        }

        $this->courses->add($course);
        $course->addStudent($this);
    }
}
