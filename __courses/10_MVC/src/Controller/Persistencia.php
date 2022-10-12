<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class Persistencia implements InterfaceControladorRequisicao
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        if (!is_null($descricao) && $descricao !== false && $descricao !== '') {
            $curso = new Curso();
            $curso->setDescricao($descricao);

            $id = filter_input(
                INPUT_GET,
                'id',
                FILTER_VALIDATE_INT
            );

            if (!is_null($id) && $id !== false) {
                $curso->setId($id);
                $this->entityManager->merge($curso);
            } else {
                $this->entityManager->persist($curso);
            }
            $this->entityManager->flush();
        }

        header('Location: /listar-cursos', true, 302);
    }
}
