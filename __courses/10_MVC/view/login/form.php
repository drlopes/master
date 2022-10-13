<?php include __DIR__ . '/../header-html.php'; ?>

    <form class="" action="/do-login" method="post">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="email@domain.com" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" name="button">Login</button>
    </form>

<?php include __DIR__ . '/../footer-html.php'; ?>
