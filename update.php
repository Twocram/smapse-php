<!doctype html>
<?php
session_start();

if(!isset($_SESSION['user'])) {
    header('Location: /account/login.php');
}

if(!isset($_GET['id'])) {
    header('Location: index.php');
}
require "./db/connect.php";

$id = $_GET['id'];
$userRes = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id'");
if(mysqli_num_rows($userRes) == 0 ) {
    header("Location: index.php");
} else {
    $user = mysqli_fetch_assoc($userRes);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обновление пользвоателя</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
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
                    Обновление пользователя
                </div>
                <div class="card-body">
                    <form id="form" method="post">
                        <div class="form-group">
                            <label for="email">Имя</label>
                            <input type="text" value="<?php echo $user['name']; ?>"
                                   class="form-control" id="name" name="name" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="<?php echo $user['email']; ?>"
                                   class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="text" value="<?php echo $user['password']; ?>"
                                   class="form-control" id="password" name="password" placeholder="Пароль">
                        </div>
                        <button type="submit" name="sub" id="sub" class="btn btn-primary">Обновить</button>
                        <?php
                        if (isset($_POST['sub'])) {

                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            if(empty($name)) {
                                echo "<div class='text-danger mt-3' id='error-message'>Заполните имя пользователя</div>";
                            }

                            if(empty($email)) {
                                echo "<div class='text-danger mt-3' id='error-message'>Заполните email пользователя</div>";
                            }

                            if(empty($password)) {
                                echo "<div class='text-danger mt-3' id='error-message'>Заполните пароль пользователя</div>";
                            }

                            if(!empty($name) && !empty($email) && !empty($password)) {
                                $req = mysqli_query($connect, "UPDATE `users` 
                                SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `id` = '$id'");
                                if($req) {
                                    header('Location: index.php');
                                } else {
                                    echo "<div class='text-danger mt-3' id='error-message'>Не удалось обновить пользователя</div>";
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</body>
</html>
