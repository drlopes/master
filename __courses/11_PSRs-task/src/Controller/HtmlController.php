<?php

namespace Alura\CRUD\Controller;

abstract class HtmlController
{
    public function renderHtml(string $path, array $data): string
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../../view/' . $path;
        $html = ob_get_clean();

        return $html;
    }
}
