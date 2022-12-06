<?php

namespace Alura\Leilao\Tests\Integration\Web;

use PHPUnit\Framework\TestCase;

class RestTest extends TestCase
{
    public function test_api_rest_deve_retornar_array_de_leiloes()
    {
        //Arrange
        $resposta = file_get_contents("http://localhost:8080/rest.php");

        //Assert
        self::assertIsArray(json_decode($resposta));
        self::assertStringContainsString('200 OK', $http_response_header[0]);
    }
}