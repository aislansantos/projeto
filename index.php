<?php
/** iniciamos a sessão */
session_start();

/** verificamos se o usuario da session está vazio ou o status
 * não está ativo, uma das condições não bater a sessão é terminada e
 * voltamos para a tela de login
 */
if (empty($_SESSION['user']) && $_SESSION['ativo'] != true) {
    session_destroy();
    header("Location: login.php");
} else {
    /** se os dados para a session estiver certo ele vai pra tela principal
     * do sistema.
     */
    header("Location: principal.php");
}

if ($_GET['acao'] === 'sair') {
    session_destroy();
    header("Location: login.php");
}

?>


<?php require('header.php'); ?>



<?php require('footer.php'); ?>