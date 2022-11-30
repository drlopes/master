<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Services\Avaliador;

require 'vendor/autoload.php';

$leilao = new Leilao('Fiat 147 0KM');

$maria = new Usuario('Maria');
$joao = new Usuario('joao');

$leilao->recebeLance(
    new Lance($joao, 2000)
);

$leilao->recebeLance(
    new Lance($maria, 2900)
);

$leiloeiro = new Avaliador();

$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

$valorEsperado = 2900;

if ($valorEsperado == $maiorValor) {
    echo "Test passed";
} else {
    echo "Test failed";
}
