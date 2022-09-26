<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Employee\{Employee};
use Alura\Bank\Service\{Authenticator};

/**
 * Commentary...
 */
class Manager extends Employee implements Authenticator
{

  function calculateBonus():float
  {
    return $this->getSalary();
  }

  public function getRole():string
  {
    return 'Manager';
  }

  public function canAuthenticate(string $password):bool
  {
    return $password === '4321';
  }

}
