<?php

require_once 'Person.php';

class Employee extends Person
{
  private readonly string $role;

  public function __construct(string $name, CPF $cpf, Address $address, string $role)
  {
    $this->name = $this->validateName($name);
    $this->cpf = $cpf;
    $this->address = $address;
    $this->role = $role;
  }

  public function getRole():string
  {
    return $this->role;
  }

}
