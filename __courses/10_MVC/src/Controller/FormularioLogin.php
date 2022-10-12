<?php

namespace Alura\Cursos\Controller;

class FormularioLogin extends ControllerComHtml implements InterfaceControladorRequisicao
{
    function __construct()
    {
        // code...
    }

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml(
            'login/formulario.php',
            [
                'title' => 'Login'
            ]
        );
    }
}
