<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/reg_log.css">
    <title>Авторизация</title>
</head>
<body>
<div class="form-container">
    <h2>Авторизация</h2>
    <form action="login.php" method="POST">
        <input type="text" name="login" placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <button type="submit">Войти</button>
    </form>
    <p>У вас нет аккаунта? <a href="registration.php">Зарегистрируйтесь</a>!</p>
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

    $result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: main.php");
    } else {
        echo "<script>alert('Неверный логин или пароль');</script>";
    }
}

mysqli_close($link);
?>