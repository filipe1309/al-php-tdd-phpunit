<?php

namespace Alura\Leilao\Tests\Model;

use PHPUnit\Framework\TestCase;
use Alura\Leilao\Model\{ Leilao, Usuario, Lance };

class LeilaoTest extends TestCase
{
    public function testLeilaoDeveReceberLances()
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilao = new Leilao('Fiat 147 0km');
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 2000));

        static::assertCount(2, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());
        static::assertEquals(2000, $leilao->getLances()[1]->getValor());
    }
}