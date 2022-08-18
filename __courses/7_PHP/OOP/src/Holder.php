<?php

require_once 'Person.php';

class Holder extends Person
{

  public function __construct(string $name, CPF $cpf, Address $address)
  {
    $this->name = $this->validateName($name);
    $this->cpf = $cpf;
    $this->address = $address;
  }

}
