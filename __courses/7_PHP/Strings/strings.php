<?php

$email = 'dlopes@id-logistics.com.br';
$pwd = 'ãéíõú123';
$fullName = 'Daniel Rodrigues Lopes';
list($firstName, $surName) = explode(' ', $fullName, 2);

$atIndex = strpos($email, '@');
$pwdlen = mb_strlen($pwd);

$user = substr($email, 0, $atIndex) . PHP_EOL;
$domain = substr($email, $atIndex + 1) . PHP_EOL;

if ($pwdlen < 8) echo 'Senha insegura' . PHP_EOL . '<br>';
echo $user . PHP_EOL  . '<br>';
echo $domain . PHP_EOL . '<br>';
echo $firstName . PHP_EOL . '<br>';
echo $surName . PHP_EOL . '<br>';

$number = '10000';
$test = $number + 1;
echo $test;
