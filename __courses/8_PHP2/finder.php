<?php

require 'vendor/autoload.php';

use GuzzleHttp\{Client};
use Symfony\Component\DomCrawler\{Crawler};
use Alura\CourseFinder\{Finder};

$client = new Client(['base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$finder = new Finder($client, $crawler);
$list = $finder->search('/cursos-online-programacao/php', '.card-curso__nome');

foreach($list as $item) {
  echo $item . PHP_EOL;
}
