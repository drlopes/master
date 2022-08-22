<?php

require_once 'src/autoload.php';
use Alura\Bank\Model\{CPF, Address, Person};
use Alura\Bank\Model\Account\{Holder, Account, SavingsAccount, CurrentAccount};
use Alura\Bank\Model\Employee\{Employee, Manager, Director, Developer, VideoEditor};
use Alura\Bank\Service\{BonusController, Authenticator};

$employee1 = new Director(
  'Michael Scott',
  new CPF('123.456.789-10'),
  new Address(
    'NY',
    'Brooklyn',
    'Madison St.',
    123
  ),
  4000
);

$authenticator = new Authenticator();
$authenticator->tryLogin($employee1, '1234');

$employees = [$employee1];

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

      <?php foreach ($employees as $employee)
      { ?>

        <div class="card">

          <p> <?= $employee->getFullName() ?> </p>
          <p> <?= $employee->getRole() ?> </p>
          <ul>
            <li>Salary: <?= $employee->getSalary(); ?> </li>
            <li>Bonus: <?= $employee->calculateBonus(); ?> </li>
            <li>CPF: <?= $employee->getCPF(); ?> </li>
          </ul>

        </div>

    <?php  } ?>

    </div>

  </body>
</html>
