<?php

require_once 'CPF.php';
require_once 'Address.php';

class Holder
{
  private readonly string $name;
  private readonly CPF $cpf;
  private readonly Address $address;

  public function __construct(string $name, CPF $cpf, Address $address)
  {
    $this->name = $this->validateName($name);
    $this->cpf = $cpf;
    $this->address = $address;
  }

  public function getCPF():string
  {
    return $this->cpf->getCPF();
  }

  public function getName():string
  {
    return $this->name;
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

  private function validateName(string $name):string
  {
    if (strlen($name) > 5) {
      return $name;
    } else {
      echo 'Name must be at least five characters long.';
      exit();
    }
  }
}
