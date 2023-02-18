<!doctype html>
<?php
require "./db/connect.php";
session_start();

if(!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание пользователя</title>
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Создание пользователя
                </div>
                <div class="card-body">
                    <form id="form" method="POST">
                        <div class="form-group">
                            <label for="email">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                        </div>
                        <button type="submit" name="sub" id="sub" class="btn btn-primary">Создать</button>
                        <?php
                        if(isset($_POST['sub'])) {
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            if(empty($name)) {
                                echo "<div class='text-danger mt-3' id='error-message'>Заполните имя пользователя</div>";
                            }

                            if(empty($password)) {
                                echo "<div class='text-danger mt-3' id='error-message'>Заполните пароль пользователя</div>";
                            }

                            if(empty($email)) {
                                echo "<div class='text-danger mt-3' id='error-message'>Заполните email пользователя</div>";
                            }

                            if(!empty($name) && !empty($password) && !empty($email)) {
                                $user = mysqli_query($connect,
                                    "SELECT * FROM `users` WHERE `email` = '$email'");
                                if(mysqli_num_rows($user) != 0) {
                                    echo "<div class='text-danger mt-3' id='error-message'>Пользователь с таким email уже существует</div>";
                                } else {
                                    $result = mysqli_query($connect,
                                        "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')");
                                    if($result) {
                                        header("Location: index.php");
                                    }
                                }
                            }
                        }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>