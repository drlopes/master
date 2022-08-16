<?php

require_once 'src/CPF.php';
require_once 'src/Address.php';
require_once 'src/Holder.php';
require_once 'src/Account.php';

$holder = new Holder(
  'Jane Doe',
  new CPF('123.456.789-10'),
  new Address('NY', 'Brooklyn', 'Madison st.', '310')
);
$account = new Account($holder);
$account->deposit(1500);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Bank</title>
  </head>
  <body>

    <hr> Name: <?= htmlentities($account->getFullName()) ?> </hr>
    <hr> Balance: $ <?= htmlentities($account->getBalance()) ?> </hr>
    <hr> CPF: <?= htmlentities($account->getCPF()) ?> </hr>
    <hr> City: <?= htmlentities($account->getCity()) ?> </hr>
    <hr> Neighborhood: <?= htmlentities($account->getNeighborhood()) ?> </hr>
    <hr> Street: <?= htmlentities($account->getStreet()) ?> </hr>
    <hr> Number: <?= htmlentities($account->getNumber()) ?> </hr>
    <hr> ID: <?= Account::getActiveAccounts();  ?> </hr>

  </body>
</html>
