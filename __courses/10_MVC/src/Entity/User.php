<?php
namespace Alura\Cursos\Entity;
/**
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $email;
    /**
     * @Column(type="string")
     */
    private $password;

    public function passwordIsCorrect(string $rawPassword): bool
    {
        return password_verify($rawPassword, $this->password);
    }
}
