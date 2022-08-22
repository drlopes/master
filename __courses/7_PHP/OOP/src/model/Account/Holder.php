<?php

namespace Alura\Bank\Model\Account;

use Alura\Bank\Model\Person;
use Alura\Bank\Model\CPF;
use Alura\Bank\Model\Address;

class Holder extends Person
{

  public function __construct(string $name, CPF $cpf, Address $address)
  {
    parent::__construct($name, $cpf, $address);
  }

}
