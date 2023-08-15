<h1 style="padding-left: 20px;">Все задачи</h1>
<div class="container">
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>
        <a href="?action=newCard&controller=card">Создать новую карточку</a>
        <br><br>
    <?php endif; ?>

    <?php foreach ($cards as $card): ?>
    <div class="card">
        <?php if ($card['image'] != 0): ?>
            <img src="/storage/images/<?= $card['image'] ?>" alt="Image" width="300px">
        <?php endif; ?>
        <h3>Название: <?= $card['name'] ?></h3>
        ID: <?= $card['id'] ?><br>
        ID Уровня: <?= $card['level_id'] ?><br>
        Описание: <?= $card['description'] ?><br>
        Баллы: <?= $card['points'] ?><br>
        ID Автора: <?= $card['author_id'] ?><br>
        
        <?php 
        if (isset($_SESSION['user_role']) && $availability[$card['id']]) {
            echo '<a href="?action=startTask&controller=card&id=' . $card['id'] . '">Начать задание</a>';
        } elseif (isset($_SESSION['user_role'])) {
            echo 'Задание уже начато';
        }
        ?>
    </div>
<?php endforeach; ?>

</div>
