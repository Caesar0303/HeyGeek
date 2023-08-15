<?php 
    session_start();
    if (isset($_SESSION['user_role'])) {
?>
<h1 style="padding-left: 20px;"><?= $message . $_SESSION['user_name'] . '!' ?></h1>
<h2 style="padding-left: 20px;">
    <?php 
        if ($_SESSION['user_role'] == 1) {
            echo 'Вы зашли как учитель';
        } else {
            echo 'Вы зашли как ученик';
        }
    } else {
        echo "<h1> Вы не авторизованы, пожалуйста авторизуйтесь или зарегистрируйтесь </h1>";
    } 
?>

</h2>