<?php

class Account
{
  private readonly string $CPF;
  private readonly string $fullName;
  private int|float $balance = 0;
  private static int $accountCounter = 0;

  public function __construct(string $CPF, string $fullName)
  {
    $this->CPF = $CPF;
    $this->fullName = $this->validateName($fullName);

    Account::$accountCounter = Account::$accountCounter + 1;
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
    return $this->fullName;
  }

  public function getCPF():string
  {
    return $this->CPF;
  }

  private function validateName(string $name):string
  {
    if (strlen($name) > 5) {
      return $name;
    } else {
      echo 'Name must be at least five(5) characters long.';
      exit();
    }
  }

  static function getAccountCounter():int
  {
    return Account::$accountCounter;
  }
}

$conta = new Account('123.456.789-10', 'Jane Doe');
$conta->deposit(12993456);
$conta->withdraw(500);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Bank</title>
  </head>
  <body>

    <div class="container">
      <div class="card">
        <header class="card-header">
          <h1> <?= htmlentities($conta->getFullName()) ?> </h1>
        </header>
        <article class="card-content">
          <ul>
            <li class="user-info">
              <label for="cpf">CPF:</label>
              <span name='cpf'> <?= htmlentities($conta->getCPF()) ?> </span>
            </li>
            <li class="user-info">
              <label for="balance">Saldo:</label>
              <span name='balance'> <?= htmlentities($conta->getBalance()) ?> </span>
            </li>
          </ul>
        </article>
      </div>

    </div>

  </body>
</html>
