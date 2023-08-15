<div class="container">
    <div class="card">
        <?php 
        if ($card['image'] != 0) {
            echo '<img src="/storage/images/' . $card['image'] . '" alt="Image" width="300px">';
        }
        ?>
        <br>
        <h3>Название: <?php echo $card['name']; ?></h3>
        <p>ID: <?php echo $card['id']; ?></p>
        <p>ID Уровня: <?php echo $card['level_id']; ?></p>
        <p>Описание: <?php echo $card['description']; ?></p>
        <p>Баллы: <?php echo $card['points']; ?></p>
        <p>ID Автора: <?php echo $card['author_id']; ?></p>
    </div>
</div>

<form action="?action=addSolution&controller=card" method="post" style="padding-left: 20px;" enctype="multipart/form-data">
    Решение
    <br>
    <input type="file" name="solution">
    <input type="hidden" name="id" value="<?= $_GET['card_id'] ?>">
    <br>
    <button type="submit">Сохранить</button>
</form>

