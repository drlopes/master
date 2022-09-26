<?php

require_once 'src/autoload.php';
use Alura\Bank\Model\Person\{CPF, Address, Person, InvalidNameException};
use Alura\Bank\Model\Employee\{Employee, Manager, Director, Developer, VideoEditor};
use Alura\Bank\Service\{BonusController, Authenticator, Authenticate};

$employee1 = new Director(
  'David Wallace',
  new CPF('123.456.789-10'),
  new Address(
    'Scranton',
    'Beets Motel',
    'Bear St.',
    123
  ),
  14000
);

try {
  $employee2 = new Manager(
    'Michael',
    new CPF('143.496.189-74'),
    new Address(
      'Scranton',
      'Beets Motel',
      'Bear St.',
      123
    ),
    6000
  );
} catch (InvalidNameException $e) {
  echo $e->getMessage() . '<br>';
} catch (InvalidArgumentException $e) {
  echo 'Invalid value given for CPF' .  '<br>';
}

$employees = [$employee1, $employee2];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Bank</title>
  </head>
  <body>

    <div class="container">

      <?php foreach ($employees as $employee) { ?>

        <div class="card">

          <p class="name"> <?=$employee->getFullName()?> </p>
          <p class="title"> <?=$employee->getRole()?> </p>
          <ul>
            <li>Salary: <?=$employee->getSalary();?> </li>
            <li>Bonus: <?=$employee->calculateBonus();?> </li>
            <li>CPF: <?=$employee->getCPF();?> </li>
            <li>City: <?=$employee->getCity();?> </li>
            <li>Neighborhood: <?=$employee->getNeighborhood();?> </li>
            <li>Street: <?=$employee->getStreet();?> </li>
            <li>House Number: <?=$employee->getHouseNumber();?> </li>
          </ul>

        </div>

      <?php } ?>

    </div>

  </body>
</html>
