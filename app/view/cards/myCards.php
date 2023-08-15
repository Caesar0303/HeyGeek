   <!-- Мои задачи -->
   <h1 style="padding-left: 20px;">Мои задачи</h1>
    <div style="padding-left: 20px;" class="wrapper">
        <?php foreach ($cards as $index => $card): ?>
            <?php if ($card['status'] == 0): ?>
                <div class="task-card">
                    <h2>Task Card #<?= ($index + 1) ?></h2>
                    <!-- Отображение данных "Моих задач" -->
                    <div class="task-details">
                        <h3>Card Details</h3>
                        <p>ID: <?= $cardDetails[$index]['id'] ?></p>
                        <p>Name: <?= $cardDetails[$index]['name'] ?></p>
                        <p>Level ID: <?= $cardDetails[$index]['level_id'] ?></p>
                        <!-- Остальные детали карты ... -->
                    </div>
                    <div class="student-details">
                        <h3>Student Details</h3>
                        <p>ID: <?= $students[$index]['id'] ?></p>
                        <p>Name: <?= $students[$index]['name'] ?></p>
                        <!-- Остальные детали студента ... -->
                    </div>
                    <div class="card-details">
                        <h3>Card</h3>
                        <p>ID: <?= $card['id'] ?></p>
                        <p>Start Time: <?= $card['start_time'] ?></p>
                        <?php if ($card['status'] != 0): ?>
                            <p>End Time: <?= $card['end_time'] ?></p>
                        <?php endif; ?>
                        <!-- Остальные детали карты ... -->
                    </div>
                    <br>
                    <a href="?action=showCard&controller=card&id=<?= $cardDetails[$index]['id'] ?>&card_id=<?= $card['id'] ?>" style="text-decoration: none;">Перейти к выполнению задачи</a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Отправленные задачи -->
    <h1 style="padding-left: 20px;">Отправленные задачи</h1>
    <div style="padding-left: 20px;" class="wrapper">
        <?php foreach ($submittedCards as $index => $card): ?>
            <div class="task-card submitted">
                <h2>Task Card #<?= ($index + 1) ?></h2>
                <!-- Отображение данных "Отправленных задач" -->
                <div class="task-details">
                    <h3>Card Details</h3>
                    <p>ID: <?= $cardDetails[$index]['id'] ?></p>
                    <p>Name: <?= $cardDetails[$index]['name'] ?></p>
                    <p>Level ID: <?= $cardDetails[$index]['level_id'] ?></p>
                    <!-- Остальные детали карты ... -->
                </div>
                <div class="student-details">
                    <h3>Student Details</h3>
                    <p>ID: <?= $students[$index]['id'] ?></p>
                    <p>Name: <?= $students[$index]['name'] ?></p>
                    <!-- Остальные детали студента ... -->
                </div>
                <div class="card-details">
                    <h3>Card</h3>
                    <p>ID: <?= $card['id'] ?></p>
                    <p>Start Time: <?= $card['start_time'] ?></p>
                    <?php if ($card['status'] != 0): ?>
                        <p>End Time: <?= $card['end_time'] ?></p>
                    <?php endif; ?>
                    <!-- Остальные детали карты ... -->
                </div>
                <br>
                <a href="?action=showCard&controller=card&id=<?= $cardDetails[$index]['id'] ?>&card_id=<?= $card['id'] ?>" style="text-decoration: none;">Посмотреть задачу</a>
                <br>
                <a href="/storage/files/<?= $card['file'] ?>" download>Скачать решение: <?= $card['file'] ?></a>
            </div>
        <?php endforeach; ?>
    </div>

    </div>
<h1 style="padding-left: 20px;">Оцененные задачи</h1>
<div style="padding-left: 20px;" class="wrapper">
    <?php foreach ($cards as $index => $card): ?>
        <?php if ($card['status'] == 2): ?>
            <div class="completed-card">
                <h2>Task Card #<?= ($index + 1) ?></h2>
                <div class="task-details">
                    <h3>Card Details</h3>
                    <p>ID: <?= $cardDetails[$index]['id'] ?></p>
                    <p>Name: <?= $cardDetails[$index]['name'] ?></p>
                    <p>Level ID: <?= $cardDetails[$index]['level_id'] ?></p>
                    <!-- Остальные детали карты ... -->
                </div>
                <h3>Student Details</h3>
                    <p>ID: <?= $students[$index]['id'] ?></p>
                    <p>Name: <?= $students[$index]['name'] ?></p>
                    <!-- Остальные детали студента ... -->
                <div class="card-details">
                    <h3>Card</h3>
                    <p>ID: <?= $card['id'] ?></p>
                    <p>Start Time: <?= $card['start_time'] ?></p>
                    <?php if ($card['status'] != 0): ?>
                        <p>End Time: <?= $card['end_time'] ?></p>
                    <?php endif; ?>
                    <!-- Остальные детали карты ... -->
                </div>
                <!-- Другие блоки с деталями, ссылками и т.д. -->
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
