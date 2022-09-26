<?php

namespace Alura\Pdo\Infrastructure\Repository;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Domain\Model\{Student, Phone};
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function returnAll(): array
    {
        $query = "SELECT * FROM students";
        $stmt = $this->connection->query($query);

        return $this->hydrateStudentsList($stmt);
    }

    public function returnFromBirthday(\DateTimeInterface $birthDate): array
    {
        $query = "SELECT * FROM students WHERE birth_date = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentsList($stmt);
    }

    public function saveStudent(Student $student): bool
    {
        if ($student->id() === null) {
            return $this->registerStudent($student);
        }

        return $this->updateStudent($student);
    }

    public function registerStudent(Student $student): bool
    {
        $query = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
        $stmt = $this->connection->prepare($query);

        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

        $opperation = $stmt->execute();

        if ($opperation) {
            $student->setStudentId($this->connection->lastInsertId());
            return $opperation;
        }
    }

    public function updateStudent(Student $student): bool
    {
        $query = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue('birth_date', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id', $student->is(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function removeStudent(Student $student): bool
    {
        $id = $student->id();
        $query = "DELETE FROM students WHERE id = :id;";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();

    }

    public function hydrateStudentsList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function fillPhonesOf(Student $student): void
    {
        $query = "SELECT id, area_code, number FROM phones WHERE student_id = ?;";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
        $stmt->execute();

        $phoneList = $stmt->fetchAll();

        foreach ($phoneList as $phoneData) {
            $phone = new Phone(
                $phoneData['id'],
                $phoneData['area_code'],
                $phoneData['number']
            );

            $student->addPhone($phone);
        }
    }

    public function studentsWithPhones(): array
    {
        $query = "
            SELECT students.id,
                   students.name,
                   students.birth_date,
                   phones.id AS phone_id,
                   phones.area_code,
                   phones.number
            FROM students
            JOIN phones ON students.id = phones.student_id;";

        $stmt = $this->connection->query($query);
        $result = $stmt->fetchAll();
        $studentsList = [];

        foreach ($result as $row) {
            if (!array_key_exists($row['id'], $studentsList)) {
                $studentsList[$row['id']] = new Student(
                    $row['id'],
                    $row['name'],
                    new \DateTimeImmutable($row['birth_date'])
                );
            }
            $phone = new Phone($row['phone_id'], $row['area_code'], $row['number']);
            $studentsList[$row['id']]->addPhone($phone);
        }

        return $studentsList;
    }
}
