<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\User;
use Alura\Cursos\Helper\FlashMessage;

class DoLogin implements RequestControllerInterface
{
    private $entityManager;
    private $userRepo;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
        $this->userRepo = $this->entityManager->getRepository(User::class);
    }

    use FlashMessage;

    public function parseRequest(): void
    {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );

        if (is_null($email) || $email === false) {
            $this->flashMessage('Invalid email address', 'danger');
            header('Location: /login');
            return;
        }

        $password = filter_input(
            INPUT_POST,
            'password',
            FILTER_SANITIZE_STRING
        );

        $user = $this->userRepo->findOneBy(['email' => $email]);

        if (is_null($user) || !$user->passwordIsCorrect($password)) {
            $this->flashMessage('Invalid email or password', 'danger');
            header('Location: /login');
            return;
        }

        $_SESSION['logged'] = true;
        $this->flashMessage('User logged in', 'success');
        header('Location: /list-courses');
    }
}
