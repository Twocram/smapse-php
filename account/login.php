<!DOCTYPE html>
<?php
require "../db/connect.php";
session_start();
if(isset($_SESSION['user'])) {
    header("Location: ../index.php");
}
?>
<html>
<head>
    <title>Login Page</title>
    <!-- Import Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Авторизация
                </div>
                <div class="card-body">
                    <form id="form" method="GET">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                        </div>
                        <button type="submit" name="sub" id="sub" class="btn btn-primary">Авторизоваться</button>
                        <?php
                        if (isset($_GET['sub'])) {
                            $email = $_GET['email'];
                            $password = $_GET['password'];
                            $user = mysqli_query($connect,
                                "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
                            echo mysqli_num_rows($user);
                            if(mysqli_num_rows($user) == 1) {
                                $_SESSION['user'] = mysqli_fetch_assoc($user);
                                header('Location: ../index.php');
                            } else {
                                echo "<div class='text-danger mt-3' id='error-message'>Неправильный email или пароль</div>";
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Import Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>