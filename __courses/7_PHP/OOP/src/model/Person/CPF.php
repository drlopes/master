<?php

namespace Alura\Bank\Model\Person;

final class CPF
{
  private readonly string $CPF;

  public function __construct(string $cpf)
  {
    $value = filter_var($cpf, FILTER_VALIDATE_REGEXP,
    [
      'options' => [
        'regexp' => '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'
        ]
    ]);

    if ($value === false) {
      throw new \InvalidArgumentException();
    } else {
      $this->cpf = $value;
    }
  }

  public function getCPF():string
  {
    return $this->cpf;
  }
}
