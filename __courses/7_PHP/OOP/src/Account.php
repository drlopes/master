<?php

class Account
{
  private static int $activeAccounts = 0;
  public readonly Holder $holder;
  private int|float $balance = 0;

  public function __construct(Holder $holder)
  {
    $this->holder = $holder;
    self::$activeAccounts = self::$activeAccounts + 1;
  }

  public function __destruct()
  {
    self::$activeAccounts = self::$activeAccounts - 1;
  }

  public function withdraw(int|float $ammount):void
  {
    if ($ammount > $this->balance) {
      echo 'Not enough funds.';
      return;
    }
    $this->balance = $this->balance - $ammount;
  }

  public function deposit(int|float $ammount):void
  {
    if ($ammount < 0) {
      echo 'Must be a positive number.';
      return;
    }
    $this->balance = $this->balance + $ammount;
  }

  public function getBalance():float
  {
    return $this->balance;
  }

  static function getActiveAccounts():int
  {
    return self::$activeAccounts;
  }
}
