<?php 
    session_start();
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
?>
<form action="?action=createNewCard&controller=card" enctype="multipart/form-data" method="post">
    Название
    <br>
    <input type="text" name="name">
    <br>
    <br>
    Описание задачи
    <br>
    <textarea name="description" cols="30" rows="10"></textarea>
    <br>
    <br>
    Баллы за выполнение задачи
    <br>
    <input type="number" name="points">
    <br>
    <br>
    Уровень задачи 
    <br>
    <select name="level_id">
        <option value="4">A</option>
        <option value="3">B</option>
        <option value="2">C</option>
        <option value="1">D</option>
    </select>
    <br>
    <br>
    Изображение задачи
    <br>
    <input type="file" name="image">
    <input type="hidden" name="author_id" value="<?= $_SESSION['user_id'] ?>">
    <br>
    <br>
    <button type="submit">Сохранить</button>
</form>
<?php 
} else {
    echo "Войдите в аккаунт";
}
?>