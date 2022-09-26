<?php

require '../db/db.php';
require '../src/ArticleHandler.php';

$list = new ArticleHandler($mysql);
$articles = $list->returnArticles();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Página administrativa</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <div id="container">
        <a class="botao botao-block" href="../index.php">Home</a>
        <h1>Página Administrativa</h1>
        <div>
            <?php foreach ($articles as $article) { ?>
                <div id="artigo-admin">
                    <p> <?= $article['titulo'] ?> </p>
                    <nav>
                        <a class="botao" href="editar-artigo.php?id=<?= $article['id']; ?>">Editar</a>
                        <a class="botao" href="excluir-artigo.php?id=<?= $article['id']; ?>">Excluir</a>
                    </nav>
                </div>
            <?php } ?>
        </div>
        <a class="botao botao-block" href="adicionar-artigo.php">Adicionar Artigo</a>
    </div>
</body>

</html>
