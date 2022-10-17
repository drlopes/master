<?php

namespace Alura\CRUD\Entity;
use Doctrine\ORM\Mapping\{Entity, Column, GeneratedValue, Id, Table};
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'users')]
class User
{
    #[Id, GeneratedValue, Column(type: Types::INTEGER)]
    private $id;

    #[Column(type: Types::STRING)]
    private $email;

    #[Column(type: Types::STRING)]
    private $password;

    public function passwordIsCorrect(string $rawPassword): bool
    {
        return password_verify($rawPassword, $this->password);
    }
}
