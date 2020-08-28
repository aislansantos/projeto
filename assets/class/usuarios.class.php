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

    /** --------- Pesquisa para confirmar se se o nome cadastrado ja existe
     * para no caso de existir editar ao invés de cadastrar novo --------- **/
    public function consultaCadastro()
    {
        /** ---  --- **/
        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function consultaEditar()
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function salvarCadastro()
    {
        if (!empty($this->id)) {
            $sql = "UPDATE usuarios SET nome = :nome, senha = :senha, email = :email, tipo = :tipo WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $this->id);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':tipo', $this->tipo);
            $stmt->execute();
        } elseif ($this->consultaCadastro() == true) {
            $sql = "INSERT INTO usuarios (nome, senha, email, tipo) VALUES (:nome, :senha, :email, :tipo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':tipo', $this->tipo);
            $stmt->execute();
        }
    }
}
