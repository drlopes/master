<?php

require_once 'vendor/autoload.php';
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$connection = ConnectionCreator::createConnection();

$query = "CREATE TABLE students (
    id INTEGER PRIMARY KEY,
    name TEXT,
    birth_date TEXT
);";

$connection->query($query);
