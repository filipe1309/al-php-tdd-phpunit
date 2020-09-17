<?php

use Alura\Leilao\Model\{ Leilao, Usuario, Lance };
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

$leilao = new Leilao('Fiat 147 0km');

$maria = new Usuario('Maria');
$joao = new Usuario('João');

$leilao->recebeLance(new Lance($joao, 2000));
$leilao->recebeLance(new Lance($maria, 2500));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

if ($maiorValor === 2500.0) {
    echo "TESTE OK";
} else {
    echo "TESTE FALHOU";
}
