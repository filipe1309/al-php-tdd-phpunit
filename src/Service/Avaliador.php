<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;
    private $maioresLances;

    public function avalia(Leilao $leilao): void
    {
        if ($leilao->estaFinalizado()) {
            throw new \DomainException('Leilao ja finalizado');
        }

        $lances = $leilao->getLances();

        if (empty($lances)) {
            throw new \DomainException('Nao eh possivel avaliar leilao vazio');
        }

        foreach ($lances as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }

        usort($lances, function ($lance1, $lance2) {
            return ($lance2->getValor() - $lance1->getValor());
        });

        $this->maioresLances = array_slice($lances, 0, 3);
    } 

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }
}