<?php require __DIR__ . './../header.php'; ?>

    <a href="/new-entry" class="btn btn-primary mb-2">New course</a>

    <ul class="list-group">
        <?php foreach ($courses as $course): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $course->description(); ?>
                <span>

                    <a href="/update-course?id=<?= $course->id(); ?>"class="btn btn-info btn-sm">Update</a>
                    <a href="/delete-course?id=<?= $course->id(); ?>" class="btn btn-danger btn-sm">Delete</a>

                </span>
            </li>
        <?php endforeach; ?>
    </ul>

<?php require __DIR__ . '/../footer.php'; ?>
