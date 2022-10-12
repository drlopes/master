<?php include __DIR__ . '/../header-html.php'; ?>

    <form class="" action="/realiza-login" method="post">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="email@domain.com" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" name="button">Entrar</button>
    </form>

<?php include __DIR__ . '/../footer-html.php'; ?>
