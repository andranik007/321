<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/reg_log.css">
    <title>Регистрация</title>
</head>
<body>
<div class="form-container">
    <h2>Регистрация</h2>
    <form action="registration.php" method="POST">
        <input type="text" name="login" placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <input type="password" name="confirm_password" placeholder="Подтвердите пароль" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <p>У вас уже есть аккаунт? <a href="login.php">Авторизируйтесь</a>!</p>
    </div>
</body>
</html>


<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "vel");

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    if (empty($login) || empty($password) || empty($confirm_password) || empty($email)) {
        echo "<script>alert('Данные введены неверно');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Пароли не совпадают');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Некорректный email');</script>";
    } else {
        $check_login = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
        $check_email = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
        
        if (mysqli_num_rows($check_login) > 0) {
            echo "<script>alert('Логин уже занят');</script>";
        } elseif (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email уже используется');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO users (login, password, email, role) VALUES ('$login', '$hashed_password', '$email', 'USER')";
            if (mysqli_query($link, $insert_query)) {
                header("Location: /ИС-4 Ханахян А.А/diploma/main.php");
                exit;
            } else {
                echo "Ошибка при регистрации: " . mysqli_error($link);
            }
        }
    }
}

mysqli_close($link);
?> 
