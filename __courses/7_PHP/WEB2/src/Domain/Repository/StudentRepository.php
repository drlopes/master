<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function returnAll(): array;

    public function returnFromBirthday(\DateTimeInterface $birthDate): array;

    public function registerStudent(Student $student): bool;

    public function removeStudent(Student $student): bool;

    public function studentsWithPhones(): array;
}
