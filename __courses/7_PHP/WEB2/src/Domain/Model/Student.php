<?php

namespace Alura\Pdo\Domain\Model;

class Student
{
    private ?int $id;
    private readonly string $name;
    private readonly \DateTimeInterface $birthDate;
    private array $phones = [];

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function setStudentId(int $id): bool
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Student ID has already been set.');
            return FALSE;
        }

        $this->id = $id;
        return TRUE;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function changeStudentName($newName)
    {
        $this->name = $newName;
    }

    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    public function addPhone(Phone $phone): void
    {
        $this->phones[] = $phone;
    }

    public function phones(): array
    {
        return $this->phones;
    }
}
