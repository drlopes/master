<?php

namespace Alura\Bank\Model\Account;

use Alura\Bank\Model\Person\{Person, CPF, Address};
use Alura\Bank\Service\Authenticator;

class Holder extends Person implements Authenticator
{

  public function __construct(string $name, CPF $cpf, Address $address)
  {
    parent::__construct($name, $cpf, $address);
  }

  public function canAuthenticate(string $password):bool
  {
    return $password === 'abcd';
  }

}
