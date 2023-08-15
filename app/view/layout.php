<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    </title>
</head>
<style>
    .user-card {
    border: 1px solid #ddd;
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    background-color: #f5f5f5;
    text-align: center;
}

.user-card h3 {
    margin: 0;
}

.user-card p {
    margin: 5px 0;
}

    body {
        font-family: Arial, sans-serif;
    }
    .container {
        padding: 20px;
    }
    .task-card.submitted {
    border: 2px solid orange; /* Оранжевая рамка */
    background-color: rgba(255, 165, 0, 0.2); /* Полупрозрачный оранжевый фон */
    margin-bottom: 20px; /* Пространство между задачами */
    padding: 10px; /* Отступ вокруг задачи */
    }
    .card {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .card h3 {
        margin: 0;
    }
    .card p {
        margin: 5px 0;
    }
    .card a {
        text-decoration: none;
        color: #007bff;
        display: inline-block;
        margin-top: 5px;
    }
    .completed-card {
        border: 2px solid green; /* Примерно так можно задать зеленую рамку */
        background-color: #eafbea; /* Примерно так можно задать зеленый фон */
        width: 300px;
        border: 1px solid #ccc;
        padding: 15px;
        margin: 10px;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);

    }
    .task-card {
        width: 300px;
        border: 1px solid #ccc;
        padding: 15px;
        margin: 10px;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .task-card h2 {
        margin-top: 0;
    }

    .task-details, .student-details, .card-details {
        border-top: 1px solid #ddd;
        padding-top: 10px;
        margin-top: 10px;
    }

    .task-details h3, .student-details h3, .card-details h3 {
        margin-top: 0;
    }

    .task-details p, .student-details p, .card-details p {
        margin: 5px 0;
    }

    .wrapper {
        display: flex;
        flex-wrap: wrap;
    }

    body {
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }
        nav a:hover {
            text-decoration: underline;
        }
</style>


<body>
<nav>
    <a href="?">Главная</a>
    <a href="?action=showAllCards&controller=card">Карточки с задачами</a>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>
    <a href="?action=showAllStudentsCards&controller=card">Карточки учеников</a>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_role'])): ?>
    <a href="?action=userCards&controller=card">Мои задачи</a>
    <?php endif; ?>
    <a href="?action=statistic&controller=card">Статистика</a>
    <?php
        if(isset($_SESSION['user_name'])) { 
            echo '<a href="?action=exit&controller=register">Выйти</a>';
        } else {
            echo '<a href="?action=exit&controller=register">Войти</a>';
        }
    ?>
</nav>
<?php 
    echo $content;
?>
</body>
</html>