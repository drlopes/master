<?php

require 'db/db.php';
require 'src/ArticleHandler.php';

$articleId = $_GET['id'];
$list = new ArticleHandler($mysql);
$article = $list->returnArticleById($articleId);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Meu Blog</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div id="container">
        <h1>
            <?= htmlentities($article['titulo']); ?>
        </h1>
        <p>
            <?= nl2br(htmlentities($article['conteudo'])); ?>
        </p>
        <div>
            <a class="botao botao-block" href="index.php">Voltar</a>
        </div>
    </div>
</body>

</html>
