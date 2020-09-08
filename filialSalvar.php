<?php
session_start();

if (empty($_SESSION['user']) or $_SESSION['ativo'] != true) {
    session_destroy();
    header("Login: login.php");
}
require('config.php');
require('assets/class/filial.class.php');


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filial Cadastro</title>
</head>

<body>
    <?php require('header.php'); ?>
    <div class="container">
        <div>
        </div>
    </div>
    <?php require('footer.php'); ?>
</body>

</html>