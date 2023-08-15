<form action="?action=rateCard&controller=card" method="post">
    Самостоятельная работа
    <input type="checkbox" name="in_time">
    <br>
    Сдан в срок
    <input type="checkbox" name="help">
    <br>
    <input type="hidden" name='student_id' value="<?= $_GET['id'] ?>">
    <input type="hidden" name='card_id' value="<?= $_GET['card_id'] ?>">
    <input type="hidden" name='task_id' value="<?= $_GET['task_id'] ?>">
    <button type="submit">Сохранить</button>
</form>