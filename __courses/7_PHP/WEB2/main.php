<?php

require_once 'vendor/autoload.php';
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;
use Alura\Pdo\Domain\Model\Student;

$connection = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($connection);

$connection->beginTransaction();

try {
    $student_1 = new Student(
        null,
        'Michael Scott',
        new \DateTimeImmutable('1996-09-20')
    );

    $student_2 = new Student(
        null,
        'Dwight Schrute',
        new \DateTimeImmutable('1996-09-20')
    );

    $repository->saveStudent($student_1);
    $repository->saveStudent($student_2);

    $connection->commit();

} catch (\Exception $e) {
    echo $e->getMessage();
    $connection->rollBack();
}

$var = $repository->studentsWithPhones();
echo $var[1]->phones()[0]->formatedPhone();
// var_dump($var);
