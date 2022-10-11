<?php include __DIR__ . '/../header-html.php'; ?>

    <form class="" action="/salvar-curso" method="post">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" class="form-control">
        </div>
        <button type="submit" name="button" class="btn btn-primary">Salvar</button>
    </form>

<?php include __DIR__ . '/../footer-html.php'; ?>
