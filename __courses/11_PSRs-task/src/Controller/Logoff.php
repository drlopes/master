<?php

namespace Alura\CRUD\Controller;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class Logoff implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        unset($_SESSION['logged']);
        session_destroy();
        return new Response(302, ['Location' => '/login']);
    }
}
