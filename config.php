<?php

/** Iniciamos variáveis para o PDO, no caso de manutenção podemos
 * alterar as variáveis ficando o codigo sem alteração
 */
/** variavel do nome do banco e onde esta o servidor */
$dsn = "mysql:dbname=projeto;host=localhost";
/** variável com usuário que acessa o banco */
$dbuser = "root";
/** variável com senha que acessa o banco */
$dbpass = "";

/** requisitamos a tentativa de acesso a base de dados */
try {
    /** Instanciamos o PDO com os dados das variaveis */
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    /** Confirmasr depois o que faz essa linha */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /** No case de erro pegamos o erro do pdo */
} catch (PDOException $e) {
    /** imprimi se houver algum erro, o proprio */
    echo "Error " . $e->getMessage();
}
