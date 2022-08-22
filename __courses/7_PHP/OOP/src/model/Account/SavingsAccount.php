<?php

namespace Alura\Bank\Model\Account;

class SavingsAccount extends Account
{
  
  public function taxPercentual():float
  {
    return 0.03;
  }

}
