<?php
session_start();


if (empty($_SESSION['user']) && $_SESSION['ativo'] != true) {
    session_destroy();
    header("Location: login.php");
} else {
    header("Location: principal.php");
}

if ($_GET[acao] === 'sair') {
    session_destroy();
    header("Location: login.php");
}

?>


<?php require('header.php'); ?>



<?php require('footer.php'); ?>