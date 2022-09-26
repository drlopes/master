<?php

require 'db/db.php';
require 'src/ArticleHandler.php';

$list = new ArticleHandler($mysql);
$articles = $list->returnArticles();

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
        <a class="botao botao-block" href="admin/index.php">Admin</a>
        <h1>PLACEHOLDER</h1>
        <?php foreach ($articles as $article) { ?>
            <?php if ($article['id'] >= 1 ) { ?>
            <h2>
                <a href="article.php?id=<?= $article['id'] ?>">
                    <?= htmlentities($article['titulo']); ?>
                </a>
            </h2>
            <p>
                <?= nl2br(htmlentities($article['conteudo'])); ?>
            </p>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>
