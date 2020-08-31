<?php
session_start();

if (empty($_SESSION['user']) && $_SESSION['ativo'] != true) {
    session_destroy();
    header("Location: login.php");
}

require('config.php');
require('assets/class/usuarios.class.php');

if (!empty($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');
    
    $usuario = new Usuarios($pdo);
    
    $usuario->setId($id);
    $usuario->deletarCadastro();

    header("Location: usuarioConsulta.php");
}
