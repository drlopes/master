<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Employee\{Employee};

/**
 * Commentary...
 */
class Developer extends Employee
{
  public function levelUp():void
  {
    $this->receivePromotion($this->getSalary() * 0.75);
  }

  public function getRole():string
  {
    return 'Developer';
  }

  public function calculateBonus():float
  {
    return 500.0;
  }
}
