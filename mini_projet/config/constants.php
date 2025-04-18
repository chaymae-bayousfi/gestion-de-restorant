<?php
    session_start();
    define('SITEURL', 'http://localhost/projet_resto/mini_projet/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'projet_resto');
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    if (!$conn) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }
    $db_select = mysqli_select_db($conn, DB_NAME);
    if (!$db_select) {
        die("Database Selection Failed: " . mysqli_error($conn));
    }
?>
