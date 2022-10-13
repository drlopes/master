<?php

namespace Alura\Cursos\Controller;

class Logoff implements RequestControllerInterface
{
    public function parseRequest(): void
    {
        session_destroy();
        header('Location: /login');
    }
}
