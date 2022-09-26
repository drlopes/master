<?php

$file1 = file('file1.txt');
$file2 = file('file2.txt');

$csvfile = fopen('csvfile.csv', 'w');

foreach($file1 as $string)
{
  $line = [trim(utf8_decode($string)), 'Sim'];
  fputcsv($csvfile, $line, ';');
}

foreach($file2 as $string)
{
  $line = [trim(utf8_decode($string)), 'Não'];
  fputcsv($csvfile, $line, ';');
}

fclose($csvfile);

$files = new SplFileObject('csvfile.csv');

while (!$files->eof()) {
  $line = $files->fgetcsv(';');
  echo $line[0] . PHP_EOL;
}
