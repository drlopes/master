<?php

require_once 'CPF.php';
require_once 'Address.php';

class Person
{
  protected string $name;
  protected CPF $cpf;
  protected Address $address;

  public function getFullName():string
  {
    return $this->name;
  }

  public function getCPF():string
  {
    return $this->cpf->getCPF();
  }

  public function getCity():string
  {
    return $this->address->getCity();
  }

  public function getNeighborhood():string
  {
    return $this->address->getNeighborhood();
  }

  public function getStreet():string
  {
    return $this->address->getStreet();
  }

  public function getNumber():string
  {
    return $this->address->getNumber();
  }

  protected function validateName(string $name):string
  {
    if (strlen($name) > 5) {
      return $name;
    } else {
      echo 'Name must be at least five characters long.';
      exit();
    }
  }

}
