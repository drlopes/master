<?php

require_once 'src/autoload.php';
use Alura\Bank\Model\Person\{CPF, Address, Person, InvalidNameException};
use Alura\Bank\Model\Account\{Holder, Account, SavingsAccount, CurrentAccount, InsuficientFundsException};
use Alura\Bank\Service\{BonusController, Authenticator, Authenticate};

$holder = new Holder(
    'Michael Scott',
    new CPF('143.496.189-34'),
    new Address(
      'Colorado',
      'Beets Motel',
      'Bear St.',
      321
    )
);

$account = new CurrentAccount($holder);

try {
  $account->deposit(150);
} catch (InvalidArgumentException $e) {
  echo 'Invalid value for deposit operation.' . '<br>';
}

try {
  $account->withdraw(20);
} catch (InsuficientFundsException $e) {
  echo $e->getMessage() . '<br>';
}
