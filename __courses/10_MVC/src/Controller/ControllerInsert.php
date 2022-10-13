<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;

class ControllerInsert extends HtmlController implements RequestControllerInterface
{
    public function parseRequest(): void
    {
        echo $this->renderHtml(
            'courses/form.php',
            [
                'title' => 'New course'
            ]
        );
    }
}
