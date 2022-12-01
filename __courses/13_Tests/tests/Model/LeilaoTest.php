<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    /**
     * @dataProvider geraLances
     */
    public function testLeilaoDeveReceberLances(int $quantidadeDeLances, Leilao $leilao, array $valores)
    {
        self::assertCount($quantidadeDeLances, $leilao->getLances());

        foreach ($valores as $index => $valor) {
            self::assertEquals($valor, $leilao->getLances()[$index]->getValor());
        }
    }

    public function testLeilaoNaoDeveAceitarLancesDoMesmoUsuarioEmSequencia () 
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode dar dois lances em seguida.');

        $joao = new Usuario('joao');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($joao, 2000));
    }

    public function testLilaoNaoDeveAceitarMaisDe5LancesDoMesmoUsuario ()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode dar mais de 5 lances no mesmo leilão.');

        $leilao = new Leilao('Brasília Amarela');
        $joao = new Usuario('joao');
        $maria = new Usuario('maria');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));
        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));

        $leilao->recebeLance(new Lance($joao, 6000));
    }

    public function geraLances()
    {
        $joao = new Usuario('joao');
        $maria = new Usuario('maria');

        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lance = new Leilao('Fusca 1972 0KM');
        $leilaoCom1Lance->recebeLance(new Lance($maria, 5000));

        return [
            '2-lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lance' => [1, $leilaoCom1Lance, [5000]],
        ];
    }

    public function geraLancesEmSequencia()
    {
        $joao = new Usuario('joao');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($joao, 2000));


        return [
            'leilao' => [$leilao],
        ];
    }
}