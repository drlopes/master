<?php

namespace Alura\Cursos\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RequestControllerInterface
{
    public function parseRequest(ServerRequestInterface $request): ResponseInterface;
}
