<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Service\Encerrador;
use Alura\Leilao\Service\EnviadorEmail;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class EncerradorTest extends TestCase
{
    private $encerrador;
    private $enviadorEmail;
    private $leilao_1;
    private $leilao_2;

    protected function setUp(): void
    {
        $this->leilao_1 = new Leilao(
            'Fiat 147 0KM',
            new DateTimeImmutable('8 days ago'),
        );

        $this->leilao_2 = new Leilao(
            'Variant 1972 0KM',
            new DateTimeImmutable('10 days ago'),
        );

        $leilaoDAO = $this->createMock(LeilaoDao::class);

        $leilaoDAO->method('recuperarFinalizados')->willReturn([$this->leilao_1, $this->leilao_2]);
        $leilaoDAO->method('recuperarNaoFinalizados')->willReturn([$this->leilao_1, $this->leilao_2]);
        $leilaoDAO->expects($this->exactly(2))
            ->method('atualiza')
            ->withConsecutive(
                [$this->leilao_1],
                [$this->leilao_2]
            );

        $this->enviadorEmail = $this->createMock(EnviadorEmail::class);
        $this->encerrador = new Encerrador($leilaoDAO, $this->enviadorEmail);
    }

    public function testLeiloesComMaisDeUmaSemanaDevemSerEncerrados()
    {
        $this->encerrador->encerra();

        $leiloesFinalizados = [$this->leilao_1, $this->leilao_2];

        self::assertCount(2, $leiloesFinalizados);
        self::assertTrue($leiloesFinalizados[0]->estaFinalizado());
        self::assertTrue($leiloesFinalizados[1]->estaFinalizado());
    }

    public function testEncerramentoDeveContinuarMesmoSeNotificacaoPorEmailFalhar () 
    {
        $exception = new \DomainException('Erro ao enviar email');
        $this->enviadorEmail->expects($this->exactly(2))
            ->method('notificarTerminoLeilao')
            ->willThrowException($exception);
        
        $this->encerrador->encerra();
    }

    public function testSoDeveEnvarLeilaoPorEmailAposFinalizado () 
    {
        $this->enviadorEmail->expects($this->exactly(2))
            ->method('notificarTerminoLeilao')
            ->willReturnCallback(function (Leilao $leilao) {
                self::assertTrue($leilao->estaFinalizado());
            });
        
        $this->encerrador->encerra();
    }
}
