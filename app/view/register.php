<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .register-container h3 {
            margin-top: 0;
            text-align: center;
        }
        .register-form {
            display: flex;
            flex-direction: column;
        }
        .register-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .register-form input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .register-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .login-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h3>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </h3>
        <form class="register-form" action="?action=registration&controller=register" method="post">
            <label for="login">Name:</label>
            <input type="text" id="login" name="login">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <button type="submit">Зарегистрироваться</button>
        </form>
        <div class="login-link">
            Уже есть аккаунт? <a href="?action=gotoauthorization&controller=register">Авторизуйтесь</a>
        </div>
    </div>
</body>
</html>
