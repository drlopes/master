<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Employee\{Employee};

/**
 * Commentary...
 */
class Director extends Employee
{

  function calculateBonus():float
  {
    return $this->getSalary() * 2;
  }

  public function canAuthenticate(string $password):bool
  {
    return $password === '1234';
  }

  public function getRole():string
  {
    return 'Director';
  }
}
