<?php

namespace Alura\Bank\Model\Account;

class CurrentAccount extends Account
{

  public function transfer(int|float $ammount, Account $account):void
  {
    if ($ammount > $this->balance) {
      echo 'Not enough funds.';
      exit();
    }
    $account->deposit($ammount);
    $this->balance -= $ammount;
  }

  public function taxPercentual():float
  {
    return 0.05;
  }
}
