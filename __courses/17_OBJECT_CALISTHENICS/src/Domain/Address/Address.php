<?php

namespace Alura\Calisthenics\Domain\Address;

class Address
{
    public string $country;
    public string $state;
    public string $city;
    public string $province;
    public string $street;
    public string $number;

    public function __construct(string $street, string $number, string $province, string $city, string $state, string $country)
    {
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->province = $province;
        $this->street = $street;
        $this->number = $number;
    }
}