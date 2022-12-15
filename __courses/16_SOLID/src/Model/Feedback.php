<?php

namespace Alura\Solid\Model;

class Feedback
{
    private int $nota;
    private ?string $depoimento;
    public function __construct(int $nota, ?string $depoimento) 
    {
        if ($nota < 9 && empty($depoimento)) {
            throw new \DomainException("Depoimento obrigatório.", 1);
        }

        $this->nota = $nota;
        $this->depoimento = $depoimento;
    }

    public function recuperarNota(): int
    {
        return $this->nota;
    }

    public function recuperarDepoimento(): ?string
    {
        return $this->depoimento;
    }
}