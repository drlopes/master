<?php include __DIR__ . '/../header.php'; ?>

    <form class="" action="/save-course" method="post">
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control">
        </div>
        <button type="submit" name="button" class="btn btn-primary">Save</button>
    </form>

<?php include __DIR__ . '/../footer.php'; ?>
