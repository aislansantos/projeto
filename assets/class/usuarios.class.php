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
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    public function consultaCadastro($i){
        $sql = "SELECT id FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }else{
            return array();
        }
    }

    public function salvarCadastro(){
        if (consultaCadastro() == true) {
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