<?php

namespace Alura\Bank\Model\Account;

abstract class Account
{
  private static int $activeAccounts = 0;
  protected int|float $balance = 0;
  protected readonly Holder $holder;

  public function __construct(Holder $holder)
  {
    $this->holder = $holder;
    self::$activeAccounts = self::$activeAccounts + 1;
  }

  public function __destruct()
  {
    self::$activeAccounts = self::$activeAccounts - 1;
  }

  public function deposit(int|float $ammount):void
  {
    if ($ammount < 0) {
      echo 'Must be a positive number.';
      return;
    }
    $this->balance += $ammount;
  }

  public function withdraw(int|float $ammount):void
  {
    $tax = $ammount * $this->taxPercentual();
    $withdraw = $ammount + $tax;
    if ($withdraw > $this->balance) {
      echo 'Not enough funds.';
      return;
    }
    $this->balance -= $withdraw;
  }

  public function getBalance():float
  {
    return $this->balance;
  }

  public function getHolderName():string
  {
    return $this->holder->getFullName();
  }

  public function getHolderCPF():string
  {
    return $this->holder->getCPF();
  }

  public function getHolderCity():string
  {
    return $this->holder->getCity();
  }

  public function getHolderNeighborhood():string
  {
    return $this->holder->getNeighborhood();
  }

  public function getHolderStreet():string
  {
    return $this->holder->getNeighborhood();
  }

  public function getHolderHouseNumber():string
  {
    return $this->holder->getHouseNumber();
  }

  static function getActiveAccounts():int
  {
    return self::$activeAccounts;
  }

  abstract function taxPercentual():float;
}
