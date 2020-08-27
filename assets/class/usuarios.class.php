<?php
class Usuarios{
    private $id;
    private $nome;
    private $senha;
    private $email;
    private $tipo;
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    
  
    public function getId()
    {
        return $this->id;
    }

    public function setId($i)
    {
     $this->id = $i;
     
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($n)
    {
        $this->nome = $n;
    }


    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($s)
    {
        $this->senha = $s;
    }

    
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($e)
    {
       $this->email = $e;
    }

    
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($t)
    {
       $this->tipo = $t;
    }

    public function listaGeral(){
        $sql = "SELECT * FROM usuarios";
        $sql = $this->pdo->query($sql);

        if ($sql->rowCount() >0) {
           return $sql->fetchAll();
        }else{
            return array();
        }
         
    }

    public function consultaCadastro($nome){
        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return true;
        }else{
            return false;
        }
    }

    public function salvarCadastro(){
        if ($this->consultaCadastro($this->nome) == true) {
            $sql = "INSERT INTO usuarios (nome, senha, email, tipo) VALUES (:nome, :senha, :email, :tipo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':tipo', $this->tipo);
            $stmt->execute();
        }else {
            $sql = "UPDATE usuarios SET nome = :nome, senha = :senha, email = :email, tipo = :tipo";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':tipo', $this->tipo);
            $stmt->execute();
        }
    }


}