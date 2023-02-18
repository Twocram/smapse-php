<?php
require "./db/connect.php";
if(!isset($_SESSION['user'])) {
    header('Location: /account/login.php');
}

if(!isset($_GET['id'])) {
    header("Location: index.php");
}

$id = $_GET['id'];
$result = mysqli_query($connect, "DELETE FROM users WHERE id = $id");
if($result) {
    header("Location: index.php");
} else {
    echo "user not deleted";
}