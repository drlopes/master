<?php

namespace Alura\Bank\Model\Account;

class InsuficientFundsException extends \DomainException
{
  public function __construct(float $value, float $balance)
  {
    $message = "You've attempted to withdraw $value, but there's currently $balance in your account.";
    parent::__construct($message);
  }
}
