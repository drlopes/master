<?php

namespace Alura\Bank\Model\Person;

class InvalidNameException extends \DomainException
{

  function __construct($string)
  {
    $strlen = strlen($string);
    $message = "Name must be at least five characters long. The name \"$string\" has only $strlen.";

    parent::__construct($message);
  }
}
