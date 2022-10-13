<?php

namespace Alura\Cursos\Controller;

class LoginForm extends HtmlController implements RequestControllerInterface
{
    public function parseRequest(): void
    {
        echo $this->renderHtml(
            'login/form.php',
            [
                'title' => 'Login'
            ]
        );
    }
}
