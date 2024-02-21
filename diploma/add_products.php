<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vel";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Запрос для получения брендов из базы данных
    $stmt = $db->query("SELECT name FROM brands");
    $brands = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $category_id = $_POST["category_id"];
    $brand_id = $_POST["brand_id"];

    // Обработка загруженного изображения
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    



    // Проверка, является ли файл изображением
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "Файл является изображением - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файл не является изображением.";
            $uploadOk = 0;
        }
    }

    // Проверка размера файла (не более 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Извините, ваш файл слишком большой.";
        $uploadOk = 0;
    }

    // Если все проверки пройдены, попытка загрузки файла
    if ($uploadOk == 0) {
        echo "Извините, ваш файл не был загружен.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Файл ". basename( $_FILES["image"]["name"]). " успешно загружен.";
            // Добавление данных в базу данных
            $image_path = $target_dir . basename($_FILES["image"]["name"]);
            $stmt = $db->prepare("INSERT INTO products (name, price, description, category_id, brand_id, img) VALUES (:name, :price, :description, :category_id, :brand_id, :img)");
            $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'category_id' => $category_id, 'brand_id' => $brand_id, 'img' => $image_path]);
        } else {
            echo "Извините, произошла ошибка при загрузке файла.";
        }
    }
}
?>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 

</head>

<body>
<div class="container">
    <h2 class="mt-5">Добавление товара</h2>
    <form method="post" action="add_product.php" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Название товара</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Бренд</label>
            <select class="form-select" id="brand" name="brand" required>
                <option value="" selected disabled>Выберите бренд</option>
                <!-- Используйте PHP-код для заполнения выпадающего списка брендов -->
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand; ?>"><?php echo $brand; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>