<?php

function funcao1()
{
    echo 'Entrei na função 1' . PHP_EOL . '<br>';
    funcao2();
    echo 'Saindo da função 1' . PHP_EOL . '<br>';
}

function funcao2()
{
    echo 'Entrei na função 2' . PHP_EOL . '<br>';
    for ($i = 1; $i <= 5; $i++) {
        echo $i . PHP_EOL . '<br>';
    }
    echo 'Saindo da função 2' . PHP_EOL . '<br>';
}

echo 'Iniciando o programa principal' . PHP_EOL . '<br>';
funcao1();
echo 'Finalizando o programa principal' . PHP_EOL . '<br>';
