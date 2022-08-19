<?php

require_once 'Person.php';

class Holder extends Person
{

  public function __construct(string $name, CPF $cpf, Address $address)
  {
    parent::__construct($name, $cpf, $address);
  }

}
