<?php

require_once 'vendor/autoload.php';
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$connection = ConnectionCreator::createConnection();

$drop = "DROP TABLE IF EXISTS students; DROP TABLE IF EXISTS phones;";

$connection->exec($drop);

$query = "
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT
    );
    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        student_id INTEGER,
        area_code TEXT,
        number TEXT,
        FOREIGN KEY (student_id) REFERENCES students(id)
    );
";

$connection->exec($query);

$connection->exec("INSERT INTO phones (area_code, number, student_id) VALUES ('35', '57564846', 1), ('35', '37469684', 1);");
