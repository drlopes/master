<?php

namespace Alura\Bank\Service;
use Alura\Bank\Model\Employee\{Director};

class Authenticator
{

  public function tryLogin(Director $director, string $password):void
  {
    if ($director->canAuthenticate($password)) {
      echo 'Access granted';
    }
    else {
      echo 'Access denied';
    }
  }
}
