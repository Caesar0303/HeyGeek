<?php foreach ($users as $user): ?>
    <div class="user-card">
        <h3><?= $user['name'] ?></h3>
        <p>Points: <?= $user['points'] ?></p>
        <p>Level: <?= $user['level_id'] ?></p>
        <!-- Другие поля пользователя -->
    </div>
<?php endforeach; ?>
