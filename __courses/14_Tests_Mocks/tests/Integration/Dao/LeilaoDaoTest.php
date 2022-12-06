<?php

namespace Alura\Leilao\Tests\Integration\Dao;

use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Dao\Leilao as LeilaoDao;
use PDO;
use PHPUnit\Framework\TestCase;

/**
 * Summary of LeilaoDaoTest
 * @author Daniel Rodrigues
 * @email dlopes@id-logistics.com.br
 */
class LeilaoDaoTest extends TestCase
{
    private static PDO $pdo;
    private static LeilaoDao $leilaoDao;

    public static function setUpBeforeClass(): void
    {
        self::$pdo = new PDO('sqlite::memory:');
        self::$leilaoDao = new LeilaoDao(self::$pdo);

        self::$pdo->exec(
            'CREATE TABLE leiloes (
                `id` INTEGER PRIMARY KEY,
                `descricao` TEXT,
                `finalizado` BOOLEAN,
                `dataInicio` TEXT
            );'
        );
    }

    protected function setUp(): void
    {
        self::$pdo->beginTransaction();
    }

    /**
     * @dataProvider leiloes
     */
    public function test_Busca_Leiloes_Nao_Finalizados(array $leiloes)
    {
        // Arrange
        $leiloes[0]->finaliza();

        foreach ($leiloes as $leilao) {
            self::$leilaoDao->salva($leilao);
        }

        // Act
        $leiloesNaoFinalizados = self::$leilaoDao->recuperarNaoFinalizados();

        // Assert
        self::assertCount(1, $leiloesNaoFinalizados);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloesNaoFinalizados);
        self::assertSame('Variant 0KM', $leiloesNaoFinalizados[0]->recuperarDescricao());
        self::assertSame(2, $leiloesNaoFinalizados[0]->recuperarId());
    }

    /**
     * @dataProvider leiloes
     */
    public function test_Busca_Leiloes_Finalizados(array $leiloes)
    {
        // Arrange
        $leiloes[1]->finaliza();
        foreach ($leiloes as $leilao) {
            self::$leilaoDao->salva($leilao);
        }

        // Act
        $leiloesFinalizados = self::$leilaoDao->recuperarFinalizados();

        // Assert
        self::assertCount(1, $leiloesFinalizados);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame('Variant 0KM', $leiloesFinalizados[0]->recuperarDescricao());
    }

    public function test_Ao_Atualizar_Leilao_Status_Deve_Ser_Alterado()
    {
        // Arrange
        $leilao = new Leilao('Brasília Amarela');
        $leilao = self::$leilaoDao->salva($leilao);
        $leilao->finaliza();
        
        //Act
        self::$leilaoDao->atualiza($leilao);

        // Assert
        $leiloes = self::$leilaoDao->recuperarFinalizados();
        self::assertCount(1, $leiloes);
        self::assertSame('Brasília Amarela', $leiloes[0]->recuperarDescricao());
    }

    protected function tearDown(): void
    {
        self::$pdo->rollBack();
    }

    public function leiloes()
    {
        $leilao_1 = new Leilao('Fiat 147 0KM');
        $leilao_2 = new Leilao('Variant 0KM');

        return [
            [
                [$leilao_1, $leilao_2]
            ]
        ];
    }
}