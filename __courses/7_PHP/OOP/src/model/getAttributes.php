<?php

namespace Alura\Bank\Model;

trait getAttributes
{
  public function __get(string $attribute)
  {
    $method = 'get' . ucfirst($attribute);
    return $this->$method();
  }
}
