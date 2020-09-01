<?php
class Usuarios
{
    private $id;
    private $nome;
    private $senha;
    private $email;
    private $tipo;
    private $pdo;


    /** Construtor inicaliza a conexão do bando de dados
     * a informação é puxada quando instanciamos a classe
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /** --------- Inicio dos Gets ---------- **/
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setId($i)
    {
        $this->id = $i;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    /** --------- final dos metodos Sets --------- **/
    /** --------- Inicio dos sets ---------- **/
    public function setNome($n)
    {
        $this->nome = $n;
    }

    public function setSenha($s)
    {
        $this->senha = $s;
    }

    public function setEmail($e)
    {
        $this->email = $e;
    }

    public function setTipo($t)
    {
        $this->tipo = $t;
    }

    /** --------- final dos metodos Sets --------- **/

    /** --------- Pesquisa de todos os registros da tabela, para popular o table de pesquisa **/
    public function listaGeral()
    {
        /** --- Comando sql para pesquisar todos os registros sem filtrar --- **/
        $sql = "SELECT * FROM usuarios";
        /** --- Como não vamos manipular nem filtar os dados podemos usar a query 
         * ao invés do prepare do statement --- **/
        $sql = $this->pdo->query($sql);
        /** --- contamos se alguma linha foi encontrada na pesquisa --- */
        if ($sql->rowCount() > 0) {
            /** --- retornamos todos os registros encontrados na consulta
             * para pegarmos na tela de consulta --- **/
            return $sql->fetchAll();
        } else {
            /** --- Se não houver registro ele retorna um array vazio --- **/
            return array();
        }
    }

    /** --------- Pesquisa para confirmar se o nome de usuário
     * ainda não existe para fazermos um novo cadastro --------- **/
    public function consultaCadastro()
    {
        /** --- Comando pesquisand o nome para selecionar se nome ja exite na tabela --- **/
        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        /** --- Preparando o comando SQL para execução **/
        $stmt = $this->pdo->prepare($sql);
        /** --- Substituimos o ":nome" da pesquisa pela variavel nome na classe **/
        $stmt->bindValue(':nome', $this->nome);
        /** --- Executamos o statement para rodar o SQL --- **/
        $stmt->execute();

        /** --- Conferimos se o nome de usuário realmente não existe para fazermos o cadastro --- **/
        if ($stmt->rowCount() == 0) {
            /** --- Se o nome não existe ele retorna true para a função --- **/
            return true;
        } else {
            /** --- Se o nome existe ele retorna falso para a função --- **/
            return false;
        }
    }

    /** --------- Função para confirmarmos se o ID ja existe para,
     * editar o registro ---------- **/
    public function consultaEditar()
    {
        /** --- Comando para procurar o id na base de dados --- **/
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        /** --- Preparando o comando SQL para execução --- **/
        $stmt = $this->pdo->prepare($sql);
        /** --- Substituimos o ":nome" da pesquisa pela variavel nome na classe --- **/
        $stmt->bindValue(':id', $this->id);
        /** --- Executamos o statement para rodar o SQL --- **/
        $stmt->execute();

        /** --- Conferimos se o ID existe se tiver alguma linha --- **/
        if ($stmt->rowCount() > 0) {
            /** --- se existir o cadastrastro ele retorna todos os dados do usuário em um array --- **/
            return $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            /** --- se não existir o cadastrastro ele retorna um array em vazio --- **/
            return array();
        }
    }

    /** -------- Função para cadastrar e alterar cadastro de ususarios --------- **/
    public function salvarCadastro()
    {
        /** --- Confirmamos que o ID é não está em branco --- **/
        if (!empty($this->id)) {
            /** --- Se o id não estiver vazio informamos o comando de Update a ser executado --- **/
            $sql = "UPDATE usuarios SET nome = :nome, senha = :senha, email = :email, tipo = :tipo WHERE id = :id";
            /** --- Preparando o comando SQL para execução **/
            $stmt = $this->pdo->prepare($sql);
            /** ---------- Substituimos os :talcoisa da pesquisa pela variavel na classe ---------- **/
            $stmt->bindValue(':id', $this->id);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':tipo', $this->tipo);
            /** ---------- terminamos de substituir os :talcoisa da pesquisa pela variavel na classe ---------- **/
            /** --- Executamos o statement para rodar o SQL --- **/
            $stmt->execute();
            /** --- Executa a instrução pra saber se ono não exite na tabela,Se o registro consultado na funão não existe --- **/
        } elseif ($this->consultaCadastro() == true) {
            /** --- Se o nome não existir informamos o comando de INSERT a ser executado  --- **/
            $sql = "INSERT INTO usuarios (nome, senha, email, tipo) VALUES (:nome, :senha, :email, :tipo)";
            /** --- Preparando o comando SQL para execução **/
            $stmt = $this->pdo->prepare($sql);
            /** ---------- Substituimos os :talcoisa da pesquisa pela variavel na classe ---------- **/
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':tipo', $this->tipo);
            /** ---------- terminamos de substituir os :talcoisa da pesquisa pela variavel na classe ---------- **/
            /** --- Executamos o statement para rodar o SQL --- **/
            $stmt->execute();
        }
    }


      /** -------- Função para deletar ususarios --------- **/
    public function deletarCadastro(){
        /** verifica se o usuario existe **/
        if ($this->consultaEditar() == true) {
            /** se existir entra na condição e prepara o comando $sql DELETE **/
            $sql = "DELETE FROM usuarios WHERE id = :id";
            /** --- Preparando o comando SQL para execução **/
            $stmt = $this->pdo->prepare($sql);
             /** ---------- Substituimos os :talcoisa da pesquisa pela variavel na classe ---------- **/
            $stmt->bindValue(':id', $this->id);
            /** --- Executamos o statement para rodar o SQL --- **/
            $stmt->execute();
        }

    }
}
