<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/cont.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>




<style>
  .navbar {
    background-color: #FF9559; /* Оранжевый цвет фона */
  }

  .navbar .nav-link {
    color: #000000 !important; /* Черный цвет ссылок */
    font-size: 30px !important; /* Размер текста ссылок */
    width: 100% !important; /* Ширина ссылок */
    text-align: center  /* Черный цвет ссылок */
  }

  .navbar .nav-link:hover {
    color: #333333 !important; /* Цвет ссылки при наведении */
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="/ИС-4 Ханахян А.А/diploma/main.php"><img class="d-block w-100" src="uploads/Logotip.png" alt="Первый слайд"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Каталог</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Аренда</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ИС-4 Ханахян А.А/diploma/about Us.php">О нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ИС-4 Ханахян А.А/diploma/contacts.php">Контакты</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-cart-fill"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-heart-fill"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/ИС-4 Ханахян А.А/diploma/login.php">Вход</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<div class="container mt-4">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="uploads/Вел1.jpg" alt="Первый слайд">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="uploads/Вел2.jpg" alt="Второй слайд">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="uploads/Вел6.jpg" alt="Третий слайд">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Предыдущий</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Следующий</span>
    </a>
  </div>
</div>
<br>



<div class="container">
  <div class="row">
    <?php
    // Подключение к базе данных
    $link = mysqli_connect("localhost", "root", "", "vel");

    // Проверка соединения
    if ($link === false) {
      die("Ошибка подключения: " . mysqli_connect_error());
    }

    // SQL запрос для получения товаров из базы данных
    $sql = "SELECT * FROM products";
    $result = mysqli_query($link, $sql);

    // Отображение товаров в карточках
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='col-md-4'>";
      echo "<div class='card' style='margin-bottom: 20px;'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>{$row['name']}</h5>";
      echo "<p class='card-text'>Цена: {$row['price']}</p>";
      echo "<button class='btn btn-primary'>Добавить в корзину</button>";
      echo "<button class='btn btn-secondary'><i class='bi bi-heart-fill'></i></button>";
      echo "</div></div></div>";
    }

    // Закрытие соединения с базой данных
    mysqli_close($link);
    ?>
  </div>
</div>








<footer class="bg-dark text-white py-1 fixed-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>2005 - 2024 &copy; Velo-shop.ru</p>
      </div>
      <div class="col-md-6">
        <p class="text-md-right">Интернет-магазин брендовых велосипедов и аксессуаров.</p>
      </div>
    </div>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>