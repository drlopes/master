<?php

include_once 'Holder.php';

class Account
{
  private static int $activeAccounts = 0;
  private readonly Holder $holder;
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

  public function getFullName():string
  {
    return $this->holder->getName();
  }

  public function getCPF():string
  {
    return $this->holder->getCPF();
  }

  public function getCity():string
  {
    return $this->holder->getCity();
  }

  public function getNeighborhood():string
  {
    return $this->holder->getNeighborhood();
  }

  public function getStreet():string
  {
    return $this->holder->getStreet();
  }

  public function getNumber():string
  {
    return $this->holder->getNumber();
  }

  static function getActiveAccounts():int
  {
    return self::$activeAccounts;
  }
}
