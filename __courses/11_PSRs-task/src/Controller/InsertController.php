<?php

namespace Alura\CRUD\Controller;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};

class InsertController extends HtmlController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderHtml(
            'courses/form-insert.php',
            [
                'title' => 'New entry'
            ]
        );
        return new Response(200, [], $html);
    }
}
