<?php

class ArticleHandler
{
    private $list;
    private readonly mysqli $mysql;

    function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function returnArticles()
    {
        $result = $this->mysql->query('
        SELECT id, titulo, conteudo FROM artigos;
        ');
        $result->fetch_all(MYSQLI_ASSOC);
        $this->list = $result;
        return $this->list;
    }

    public function returnArticleById($id): array
    {
        $selection = $this->mysql->prepare("
        SELECT id, titulo, conteudo FROM artigos WHERE id = ?;
        ");
        $selection->bind_param('s', $id);
        $selection->execute();
        $article = $selection->get_result()->fetch_assoc();
        return $article;
    }

    public function createArticle(string $title, string $content): void
    {
        $selection = $this->mysql->prepare("
        INSERT INTO artigos (titulo, conteudo) VALUES (?, ?);
        ");
        $selection->bind_param('ss', $title, $content);
        $selection->execute();
    }

    public function deleteArticle($id): void
    {
        $selection = $this->mysql->prepare("
        DELETE FROM artigos WHERE id = ?;
        ");
        $selection->bind_param('s', $id);
        $selection->execute();
    }

    public function editArticle($id, $title, $content): void
    {
        $selection = $this->mysql->prepare("
        UPDATE `artigos`
        SET `titulo` = ?, `conteudo` = ?
        WHERE `artigos`.`id` = ?;
        ");
        $selection->bind_param('sss', $title, $content, $id);
        $selection->execute();
    }
}
