<?php
session_start();
if (empty($_SESSION['user']) && $_SESSION['ativo'] != true) {
    session_destroy();
    header("Location: login.php");
}
require("config.php");
require("assets/class/filial.class.php");

$filial = new Filial($pdo);

?>

<?php require("header.php"); ?>

<div class="container">
    <div>
        <h4>Filiais - Consulta</h4>
        <hr>
        <a href="#" class="btn btn-info">Novo</a>
        <br><br>

        <table class="table table-striped table-hover" id="tabelaUser">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $lista = $filial->listaGeral();
                foreach ($lista as $item) :
                ?>
                    <tr>
                        <td><?= $item['nome']; ?></td>
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

<?php require("footer.php"); ?>