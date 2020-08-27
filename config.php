<?php
$dsn="mysql:dbname=projeto;host=localhost";
$dbuser = "root";
$dbpass ="";


try {
$pdo = new PDO($dsn,$dbuser,$dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error ".$e->getMessage();
}