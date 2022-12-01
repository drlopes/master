<?php

namespace Alura\Leilao\Model;

use PharIo\Version\GreaterThanOrEqualToVersionConstraint;

class Leilao
{
    private $lances;
    private $lancesIgnorados;
    private $descricao;
    private $lastUser;
    private $currentUser;
    private $acabou = false;

    public function __construct (string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance (Lance $lance)
    {
        if ($this->acabou) {
            throw new \DomainException('Não é permitido dar lances em um leilão finalizado');
        }

        $this->currentUser = $lance->getUsuario();

        if ($this->currentUser == $this->lastUser) {
            $this->lancesIgnorados[] = $lance;
            throw new \DomainException('Usuário não pode dar dois lances em seguida.');
        }

        $totalLancesUsuario = $this->getQntDeLances($this->currentUser);

        if ($totalLancesUsuario >= 5) {
            throw new \DomainException('Usuário não pode dar mais de 5 lances no mesmo leilão.');
        }

        $this->lastUser = $this->currentUser;

        $this->lances[] = $lance;
    }

    public function getLances ()
    {
        return $this->lances;
    }

    public function getLancesIgnorados (): array
    {
        return $this->lancesIgnorados;
    }

    public function getQntDeLances (Usuario $usuarioAtual)
    {
        $quantity = array_reduce(
            $this->lances,
            function (int $totalAcumulado, Lance $lanceAtual) use ($usuarioAtual) {
                if ($lanceAtual->getUsuario() == $usuarioAtual) {
                    return $totalAcumulado + 1;
                }

                return $totalAcumulado;
            },
            0
        );

        return $quantity;
    }
    
    public function finalizaLeilao ()
    {
        $this->acabou = true;
    }

    public function acabou (): bool
    {
        return $this->acabou;
    } 
}
