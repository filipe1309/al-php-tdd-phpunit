<?php

namespace Alura\Leilao\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Leilao\Model\{ Leilao, Usuario, Lance };
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testOAvaliadorDeveEncontrarOMaiorValorDeLance(Leilao $leilao)
    {
        $leiloeiro = new Avaliador();

        # Act/When - A execução da regra de negócio
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

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
        $leiloeiro = new Avaliador();

        # Act/When - A execução da regra de negócio
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

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
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maioresLancesArr = $leiloeiro->getMaioresLances();

        static::assertCount(3, $maioresLancesArr);
        static::assertEquals((float) 2500, $maioresLancesArr[0]->getValor());
        static::assertEquals((float) 2000, $maioresLancesArr[1]->getValor());
        static::assertEquals((float) 1700, $maioresLancesArr[2]->getValor());
    }

    public function leilaoEmOrdemCrescente()
    {
         # Arrange/Given - A inicialização do cenário
         $leilao = new Leilao('Fiat 147 0km');

         $maria = new Usuario('Maria');
         $joao = new Usuario('João');
         $ana = new Usuario('Ana');
 
         $leilao->recebeLance(new Lance($ana, 1700));
         $leilao->recebeLance(new Lance($joao, 2000));
         $leilao->recebeLance(new Lance($maria, 2500));

         return [
             [$leilao]
        ];
    }

    public function leilaoEmOrdemDecrescente()
    {
         # Arrange/Given - A inicialização do cenário
         $leilao = new Leilao('Fiat 147 0km');

         $maria = new Usuario('Maria');
         $joao = new Usuario('João');
         $ana = new Usuario('Ana');
 
         $leilao->recebeLance(new Lance($maria, 2500));
         $leilao->recebeLance(new Lance($joao, 2000));
         $leilao->recebeLance(new Lance($ana, 1700));

         return [
             [$leilao]
        ];
    }

    public function leilaoEmOrdemAleatoria()
    {
         # Arrange/Given - A inicialização do cenário
         $leilao = new Leilao('Fiat 147 0km');

         $maria = new Usuario('Maria');
         $joao = new Usuario('João');
         $ana = new Usuario('Ana');
 
         $leilao->recebeLance(new Lance($joao, 2000));
         $leilao->recebeLance(new Lance($maria, 2500));
         $leilao->recebeLance(new Lance($ana, 1700));

         return [
             [$leilao]
        ];
    }
}