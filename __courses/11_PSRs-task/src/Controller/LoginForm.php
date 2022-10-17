<?php

namespace Alura\CRUD\Controller;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class LoginForm extends HtmlController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderHtml(
            'login/form.php',
            [
                'title' => 'Login'
            ]
        );

        return new Response(200, [], $html);
    }
}
