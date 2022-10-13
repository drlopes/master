<?php include __DIR__ . '/../header-html.php'; ?>

    <form action="/save-course<?= isset($course) ? '?id=' . $course->getId() : null; ?>" method="post">
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="<?= isset($course) ? htmlentities($course->getDescription()) : null; ?>">
        </div>
        <button type="submit" name="button" class="btn btn-primary">Save</button>
    </form>

<?php include __DIR__ . '/../footer-html.php'; ?>
