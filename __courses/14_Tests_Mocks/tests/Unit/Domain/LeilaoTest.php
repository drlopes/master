<?php

namespace Alura\Leilao\Tests\Domain;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use DomainException;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function test_Propor_Lance_Em_Leilao_Finalizado_Deve_Lancar_Excecao()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Este leilão já está finalizado');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->finaliza();

        $leilao->recebeLance(new Lance(new Usuario(''), 1000));
    }

    /**
     * @param int $qtdEsperado
     * @param Lance[] $lances
     * @dataProvider dadosParaProporLances
     */
    public function test_Propor_Lances_Em_Leilao_Deve_Funcionar(int $qtdEsperado, array $lances)
    {
        $leilao = new Leilao('Fiat 147 0KM');
        foreach ($lances as $lance) {
            $leilao->recebeLance($lance);
        }

        static::assertCount($qtdEsperado, $leilao->getLances());
    }

    public function test_Mesmo_Usuario_Nao_Pode_Propor_Dois_Lances_Seguidos()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Usuário já deu o último lance');
        $usuario = new Usuario('Ganancioso');

        $leilao = new Leilao('Objeto inútil');

        $leilao->recebeLance(new Lance($usuario, 1000));
        $leilao->recebeLance(new Lance($usuario, 1100));
    }

    public function dadosParaProporLances()
    {
        $usuario1 = new Usuario('Usuário 1');
        $usuario2 = new Usuario('Usuário 2');
        return [
            [1, [new Lance($usuario1, 1000)]],
            [2, [new Lance($usuario1, 1000), new Lance($usuario2, 2000)]],
        ];
    }
}
