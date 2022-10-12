<?php

namespace Alura\Cursos\Controller;

abstract class ControllerComHtml
{
    public function renderizaHtml(string $path, array $data): string
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../../view/' . $path;
        $html = ob_get_clean();

        return $html;
    }
}
