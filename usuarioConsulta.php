<?php
session_start();

if (empty($_SESSION['user']) && $_SESSION['ativo']!= true  ) {
    session_destroy();
    header("Location: login.php");
}
require('config.php');
require('assets/class/usuarios.class.php');

$usuario = new Usuarios($pdo);



?>


<?php require('header.php'); ?>

<div class="container">
    <div>
        <h4>Usuários - Consulta</h4>
        <hr>
        <a href="#" class="btn btn-info">Novo</a>
        <br><br>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $lista = $usuario->listaGeral();
                foreach($lista as $item):
                ?>
                <tr>
                    <td><?= $item['nome']; ?></td>
                    <td><?= $item['email']; ?></td>
                    <td><?php if ( $item['tipo'] === 'opr') {
                        echo 'Operador';
                    }else{
                        echo 'Administrador';
                    } ?></td>
                    <td>
                        <a href="#" class="btn btn-info">Editar</a>
                        <a href="#" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('footer.php'); ?>