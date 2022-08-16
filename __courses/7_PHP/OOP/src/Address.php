<?php

class Address
{
  private readonly string $city;
  private readonly string $neighborhood;
  private readonly string $street;
  private readonly string $number;

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

  public function getNumber():string
  {
    return $this->number;
  }
}
