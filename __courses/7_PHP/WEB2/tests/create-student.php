<?php

require_once 'vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

$student = new Student(null, 'Daniel Lopes', new \DateTimeImmutable('1996-09-20'));

$query = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':name', $student->name());
$stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
$stmt->execute();
