<?php

class Account
{
  private string $CPF;
  private string $fullName;
  private int|float $balance = 0;

  public function withdraw(int|float $ammount):void
  {
    if ($ammount > $this->balance) {
      echo 'Not enough funds';
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

  public function setFullName(string $fullName):void
  {
    $this->fullName = $fullName;
  }

  public function getFullName():string
  {
    return $this->fullName;
  }

  public function setCPF(string $CPF):void
  {
    $this->CPF = $CPF;
  }

  public function getCPF():string
  {
    return $this->CPF;
  }

}

$conta = new Account();
$conta->setCPF('123.456.789-10');
$conta->setFullName('Daniel Rodrigues Lopes');

echo '<hr>Nome: ' . htmlentities($conta->getFullName()) . '.<hr>';
echo '<hr>CPF: ' . htmlentities($conta->getCPF()) . '.<hr>';

$conta->deposit(10000);
echo '<hr>Saldo: ' . $conta->getBalance() . '.<hr>';

$conta->withdraw(500);
echo '<hr>Saldo: ' . $conta->getBalance() . '.<hr>';
