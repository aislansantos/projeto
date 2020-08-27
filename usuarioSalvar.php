<?php
session_start();

if (empty($_SESSION['user']) && $_SESSION['ativo']!= true  ) {
    session_destroy();
    header("Location: login.php");
}
require('config.php');
require('assets/class/usuarios.class.php');

if (!empty($_POST['nome'])) {
    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $senha = filter_input(INPUT_POST, 'senha');
    $email = filter_input(INPUT_POST, 'email');
    $tipo = filter_input(INPUT_POST, 'tipo');

    $usuario = new Usuarios($pdo);

    $usuario->setId($id);
    $usuario->setNome($nome);
    $usuario->setSenha($senha);
    $usuario->setEmail($email);
    $usuario->setTipo($tipo);

    $usuario->salvarCadastro();


}



?>


<?php require('header.php'); ?>


<div class="container">
    <div>
        <h4>Usuários - Cadastro</h4>
        <hr>
        <a href="usuarioConsulta.php" class="btn btn-info">Consulta</a>
        <br><br>
        <form action="" method="post" class="form-group">
            <input type="hidden" name="id">
            <label for=""></label>Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control">
            <label for=""></label>Senha:</label>
            <input type="text" name="senha" id="senha" class="form-control">
            <label for=""></label>email:</label>
            <input type="text" name="email" id="email" class="form-control">
            <label for=""></label>tipo:</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="opr">Operacional</option>
                <option value="adm">Administrador</option>
            </select>
            <input type="submit" value="Salvar">
        </form>
    </div>
</div>


<?php require('footer.php'); ?>