<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=dashboard", "root", "123456");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión");
}
