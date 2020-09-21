<?php

namespace Alura\Leilao\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Leilao\Model\{ Leilao, Usuario, Lance };
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    protected function setUp(): void
    {
        // echo 'Executando setUp...' . PHP_EOL;
        $this->leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testOAvaliadorDeveEncontrarOMaiorValorDeLance(Leilao $leilao)
    {
        # Act/When - A execução da regra de negócio
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        # Assert/Then - A verificação do resultado
        $valorEsperado = (float) 2500;

        self::assertEquals($valorEsperado, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testOAvaliadorDeveEncontrarOMenorValorDeLance(Leilao $leilao)
    {
        # Act/When - A execução da regra de negócio
        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        # Assert/Then - A verificação do resultado
        $valorEsperado = (float) 1700;

        self::assertEquals($valorEsperado, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testOAvaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);

        $maioresLancesArr = $this->leiloeiro->getMaioresLances();

        static::assertCount(3, $maioresLancesArr);
        static::assertEquals((float) 2500, $maioresLancesArr[0]->getValor());
        static::assertEquals((float) 2000, $maioresLancesArr[1]->getValor());
        static::assertEquals((float) 1700, $maioresLancesArr[2]->getValor());
    }

    /* --- DADOS --- */

    public function leilaoEmOrdemCrescente()
    {
        // echo 'Criando em ordem crescente...' . PHP_EOL;

         # Arrange/Given - A inicialização do cenário
         $leilao = new Leilao('Fiat 147 0km');

         $maria = new Usuario('Maria');
         $joao = new Usuario('João');
         $ana = new Usuario('Ana');
 
         $leilao->recebeLance(new Lance($ana, 1700));
         $leilao->recebeLance(new Lance($joao, 2000));
         $leilao->recebeLance(new Lance($maria, 2500));

         return [
            'ordem-crescente' => [$leilao]
        ];
    }

    public function leilaoEmOrdemDecrescente()
    {
        // echo 'Criando em ordem decrescente...' . PHP_EOL;

         # Arrange/Given - A inicialização do cenário
         $leilao = new Leilao('Fiat 147 0km');

         $maria = new Usuario('Maria');
         $joao = new Usuario('João');
         $ana = new Usuario('Ana');
 
         $leilao->recebeLance(new Lance($maria, 2500));
         $leilao->recebeLance(new Lance($joao, 2000));
         $leilao->recebeLance(new Lance($ana, 1700));

         return [
            'ordem-decrescente' => [$leilao]
        ];
    }

    public function leilaoEmOrdemAleatoria()
    {
        // echo 'Criando em ordem aleatoria...' . PHP_EOL;

        # Arrange/Given - A inicialização do cenário
         $leilao = new Leilao('Fiat 147 0km');

         $maria = new Usuario('Maria');
         $joao = new Usuario('João');
         $ana = new Usuario('Ana');
 
         $leilao->recebeLance(new Lance($joao, 2000));
         $leilao->recebeLance(new Lance($maria, 2500));
         $leilao->recebeLance(new Lance($ana, 1700));

         return [
            'ordem-aleatoria' => [$leilao]
        ];
    }
}