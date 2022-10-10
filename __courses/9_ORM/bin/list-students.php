<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Alura\Doctrine\Helper\EntityManagerCreator;
use Alura\Doctrine\Entity\{Student, Phone, Course};

$entityManager = EntityManagerCreator::createEntityManager();
$studentRepository = $entityManager->getRepository(Student::class);

if (!isset($argv[1])) {
    echo "Must pass one of the folowing arguments: id 'id', all.";
} else {
    switch ($argv[1]) {
        case 'all':
            $studentsList = $studentRepository->findAll();

            echo "________________________________________" . PHP_EOL;

            foreach ($studentsList as $student) {

                echo "Nome: $student->name" . PHP_EOL;
                echo "ID: $student->id" . PHP_EOL;
                echo "Phones: ";

                echo implode(', ', $student->phones()
                    ->map(fn (Phone $phone) => $phone->number)
                    ->toArray());

                echo PHP_EOL . "Courses: ";

                echo implode(', ', $student->courses()
                    ->map(fn (Course $course) => $course->name)
                    ->toArray());

                echo PHP_EOL;
                echo "________________________________________";
                echo PHP_EOL;

            }
        break;

        case 'id':
        $id = $argv[2];
        $res =  $studentRepository->findOneBy(['id' => $id]);
        if (isset($res->name)) {
            echo $res->name;
        } else {
            echo '';
        }

        default:
        break;
    }
}
