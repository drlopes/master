<?php

/**
 *
 */
namespace Alura\Bank\Service;

interface Authenticator
{

  public function canAuthenticate(string $password):bool;

}
