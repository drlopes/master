<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Employee\{Employee};
use Alura\Bank\Service\{Authenticator};

/**
 * Commentary...
 */
class Director extends Employee implements Authenticator
{

  function calculateBonus():float
  {
    return $this->getSalary() * 2;
  }

  public function getRole():string
  {
    return 'Director';
  }

  public function canAuthenticate(string $password):bool
  {
    return $password === '1234';
  }
}
