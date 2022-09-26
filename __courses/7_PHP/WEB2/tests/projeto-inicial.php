<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Daniel Rodrigues',
    new \DateTimeImmutable('1996-09-20')
);

echo $student->age();
