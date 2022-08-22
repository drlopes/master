<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Employee\{Employee};

/**
 * Commentary...
 */
class Manager extends Employee
{

  function calculateBonus():float
  {
    return $this->getSalary();
  }

  public function getRole():string
  {
    return 'Manager';
  }
}
