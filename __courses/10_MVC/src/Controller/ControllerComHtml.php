<?php

namespace Alura\Cursos\Controller;

class ControllerComHtml
{
    public function renderizaHtml(string $path, array $data): void
    {
        extract($data);
        require __DIR__ . '/../../view/' . $path;
    }
}
