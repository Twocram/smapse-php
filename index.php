<?php
session_start();
if(!isset($_SESSION["user"])) {
    header('Location: /account/login.php');
}
require "./db/connect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User output</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand">User Management</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Все пользователи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Создать пользователя</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account/logout.php">Выйти</a>
                </li>
            </ul>
        </div>
        <div class="navbar-text">
            Добро пожаловать, <?php echo $_SESSION['user']['name']; ?>
        </div>
    </nav>
    <div class="container">
        <h1>Список пользвоателей:</h1>
        <?php
        $userId = $_SESSION["user"]['id'];
        $result = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` != '$userId'");
        while ($row = $result->fetch_assoc()) {
            echo "
        <div class='card mb-3'>
                <div class='card-body'>
                <h5 class='card-title'>Информация о пользователе</h5>
                <p class='card-text'>Имя: {$row["name"]}</p>
                <p class='card-text'>Email: {$row["email"]}</p>
                <div class='d-flex justify-content-start'>
                <a href='update.php?id={$row["id"]}'>
                <button type='button' class='btn btn-primary mr-2'>Обновить</button>
                </a>
                <a href='delete.php?id={$row["id"]}'>
                <button type='button' class='btn btn-danger'>Удалить</button>
                </a>
              </div>
            </div>
        </div>
        ";
        }
        ?>

    </div>
    <!-- Import Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>