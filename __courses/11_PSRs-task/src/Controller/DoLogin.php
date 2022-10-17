<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Entity\User;
use Alura\CRUD\Helper\FlashMessage;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};

class DoLogin implements RequestHandlerInterface
{
    private $entityManager;
    private $userRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepo = $this->entityManager->getRepository(User::class);
    }

    use FlashMessage;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $email = filter_var($parsedBody['email'], FILTER_VALIDATE_EMAIL);

        if (is_null($email) || $email === false) {
            $this->flashMessage('Invalid email address', 'danger');
            header('Location: /login');
            quit();
        }

        $password = filter_var($parsedBody['password'], FILTER_SANITIZE_STRING);

        $user = $this->userRepo->findOneBy(['email' => $email]);

        if (is_null($user) || !$user->passwordIsCorrect($password)) {
            $this->flashMessage('Invalid email or password', 'danger');
            header('Location: /login');
            quit();
        }

        $_SESSION['logged'] = TRUE;
        $this->flashMessage('User logged in', 'success');
        return new Response(302, ['Location' => '/list-courses']);
    }
}
