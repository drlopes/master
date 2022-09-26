<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Person\{Person, CPF, Address};

abstract class Employee extends Person
{
  private readonly string $role;
  private int $salary;

  public function __construct(string $name, CPF $cpf, Address $address, int $salary)
  {
    parent::__construct($name, $cpf, $address);
    $this->salary = $salary;
  }

  abstract function getRole():string;
  abstract function calculateBonus():float;

  public function getSalary():float
  {
    return $this->salary;
  }

  public function receivePromotion(float $ammount):void
  {
    if ($ammount < 0) {
      echo 'Value should be a positive number';
      return;
    }
    $this->salary += $ammount;
  }

}
