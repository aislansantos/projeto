<?php
session_start();

if (empty($_SESSION['user']) && $_SESSION['ativo'] != true) {
    session_destroy();
    header("Location: login.php");
}
require('config.php');
require('assets/class/usuarios.class.php');

$usuario = new Usuarios($pdo);



if (!empty($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');

    $usuario->setId($id);
    $lista = $usuario->consultaEditar();
} else {
    $lista = null;
}

if (isset($_POST['nome'])) {
    $nome = filter_input(INPUT_POST, 'nome');
    $senha = filter_input(INPUT_POST, 'senha');
    $email = filter_input(INPUT_POST, 'email');
    $tipo = filter_input(INPUT_POST, 'tipo');


    $usuario->setNome($nome);
    $usuario->setSenha($senha);
    $usuario->setEmail($email);
    $usuario->setTipo($tipo);

    $usuario->salvarCadastro();
    header("Location: usuarioConsulta.php");
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

            <input type="hidden" name="id" id="id" class="form-control" value="<?php if (!empty($lista['id'])) {
                                                                                    echo $lista['id'];
                                                                                } ?>" readOnly="true">
            <label for=""></label>Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value=<?php if (!empty($lista['nome'])) {
                                                                                    echo $lista['nome'];
                                                                                } ?>>

            <label for=""></label>email:</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php if (!empty($lista['email'])) {
                                                                                        echo $lista['email'];
                                                                                    } ?>">
            <label for=""></label>Senha:</label>
            <input type="text" name="senha" id="senha" class="form-control" value="<?php if (!empty($lista['senha'])) {
                                                                                        echo $lista['senha'];
                                                                                    } ?>" maxlength="10">
            <label for=""></label>tipo:</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="adm" <?php if (!empty($lista['tipo'])) {
                                        if ($lista['tipo'] == 'adm') echo "selected";
                                    } ?>>Administrador</option>
                <option value="opr" <?php if (!empty($lista['tipo'])) {
                                        if ($lista['tipo'] == 'opr') echo "selected";
                                    } ?>>Operacional</option>
            </select>
            </select>
            <br>
            <input type="submit" class="btn btn-info" value="Salvar">
        </form>
    </div>
</div>


<?php require('footer.php'); ?>