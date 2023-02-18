<?php

define('SERVER', 'localhost');
define('DB_NAME', 'smapse');
define('USER', 'root');
define('PASSWORD', '');

$connect = mysqli_connect(SERVER, USER, PASSWORD, DB_NAME);

if (!$connect) {
    echo "Не удалось подключиться к базе данных!";
}
