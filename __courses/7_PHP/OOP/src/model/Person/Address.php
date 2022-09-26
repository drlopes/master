<?php

namespace Alura\Bank\Model\Person;
use Alura\Bank\Model\{getAttributes};

final class Address
{
  private string $city;
  private string $neighborhood;
  private string $street;
  private string $number;
  use getAttributes;

  public function __construct(
    string $city,
    string $neighborhood,
    string $street,
    string $number
  )
  {
    $this->city = $city;
    $this->neighborhood = $neighborhood;
    $this->street = $street;
    $this->number = $number;
  }

  public function __toString():string
  {
    return '<br>' . "$this->street,
    $this->number, $this->neighborhood,
    $this->city" . '<br>';
  }

  public function getCity():string
  {
    return $this->city;
  }

  public function getNeighborhood():string
  {
    return $this->neighborhood;
  }

  public function getStreet():string
  {
    return $this->street;
  }

  public function getHouseNumber():string
  {
    return $this->number;
  }
}
