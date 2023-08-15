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
        .login-container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h3 {
            margin-top: 0;
            text-align: center;
        }
        .login-form {
            display: flex;
            flex-direction: column;
        }
        .login-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .login-form input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </h3>
        <form class="login-form" action="?action=authorization&controller=register" method="post">
            <label for="login">Name:</label>
            <input type="text" id="login" name="login">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <button type="submit">Войти</button>
        </form>
        <div class="register-link">
            Нет аккаунта? <a href="?action=gotoregistration&controller=register">Зарегистрируйтесь</a>
        </div>
    </div>
</body>
</html>
