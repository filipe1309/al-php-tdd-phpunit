<?php

namespace Alura\Leilao\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Leilao\Model\{ Leilao, Usuario, Lance };
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    public function testOAvaliadorDeveEncontrarOMaiorValorDeLanceEmOrdemCrescente()
    {
        # Arrange/Given - A inicialização do cenário
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leiloeiro = new Avaliador();

        # Act/When - A execução da regra de negócio
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        # Assert/Then - A verificação do resultado
        $valorEsperado = (float) 2500;

        self::assertEquals($valorEsperado, $maiorValor);
    }
}