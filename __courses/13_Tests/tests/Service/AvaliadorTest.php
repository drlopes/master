<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Services\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    protected function setUp (): void
    {
        $this->leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        self::assertEquals(3000, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        self::assertEquals(2000, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOsTresMaioresLances(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);;

        $maioresLances = $this->leiloeiro->getMaioresLances();

        self::assertCount(3, $maioresLances);
        self::assertEquals(3000, $maioresLances[0]->getValor());
        self::assertEquals(2900, $maioresLances[1]->getValor());
        self::assertEquals(2500, $maioresLances[2]->getValor());
    }

    public function testLeilaoVazioNaoPodeSerAvaliado () 
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar um leilão vazio.');

        $leilao = new Leilao('Brasília Amarela');
        $this->leiloeiro->avalia($leilao);
    }

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testLeilaoFinalizadoNaoPodeSerAvaliado (Leilao $leilao)
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar um leilão finalizado.');

        $this->leiloeiro->avalia($leilao);
        $this->leiloeiro->avalia($leilao);
    }

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testLeilaoFinalizadoNaoPodeReceberLances (Leilao $leilao)
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é permitido dar lances em um leilão finalizado');

        $this->leiloeiro->avalia($leilao);
        $leilao->recebeLance(new Lance(new Usuario('teste'), 1000));
    }

    function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('joao');
        $pedro = new Usuario('pedro');
        $thiago = new Usuario('thiago');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($pedro, 2900));
        $leilao->recebeLance(new Lance($thiago, 3000));

        return [
            'ordem-crescente' => [$leilao],
        ];
    }

    function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('joao');
        $pedro = new Usuario('pedro');
        $thiago = new Usuario('thiago');

        $leilao->recebeLance(new Lance($thiago, 3000));
        $leilao->recebeLance(new Lance($pedro, 2900));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        return [
            'ordem-decrescente' => [$leilao],
        ];
    }

    function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('joao');
        $pedro = new Usuario('pedro');
        $thiago = new Usuario('thiago');

        $leilao->recebeLance(new Lance($pedro, 2900));
        $leilao->recebeLance(new Lance($thiago, 3000));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        return [
            'ordem-aleatoria' => [$leilao],
        ];
    }
}
