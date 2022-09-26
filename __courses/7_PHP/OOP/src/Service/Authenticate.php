<?php

namespace Alura\Bank\Service;

use Alura\Bank\Service\{Authenticator};

class Authenticate
{

  public function tryLogin(Authenticator $authenticator, string $password):void
  {
    if ($authenticator->canAuthenticate($password)) {
      echo 'Access granted';
    }
    else {
      echo 'Access denied';
    }
  }
}
