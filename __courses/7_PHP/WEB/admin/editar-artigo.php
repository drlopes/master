<?php

require '../db/db.php';
require '../src/ArticleHandler.php';

$titulo = '';
$conteudo = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $list = new ArticleHandler($mysql);
    $article = $list->returnArticleById($articleId);
    $titulo = $article['titulo'];
    $conteudo = $article['conteudo'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $printer  = new ArticleHandler($mysql);
    $printer->editArticle($_POST['id'], $_POST['titulo'], $_POST['conteudo']);
    header('location: index.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <title>Editar Artigo</title>
</head>

<body>
    <div id="container">
        <h1>Editar Artigo</h1>
        <form action="editar-artigo.php" method="post">
            <p>
                <label for="titulo">Digite o novo título do artigo</label>
                <input class="campo-form" type="text" name="titulo" id="titulo" value="<?= $titulo; ?>" />
            </p>
            <p>
                <label for="conteudo">Digite o novo conteúdo do artigo</label>
                <textarea class="campo-form" type="text" name="conteudo" id="titulo"><?= $conteudo; ?></textarea>
            </p>
            <p>
                <input type="hidden" name="id" value="<?= $article['id']; ?>" />
            </p>
            <p>
                <button class="botao">Editar Artigo</button>
            </p>
        </form>
    </div>
</body>

</html>
