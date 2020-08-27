<?php
class Usuarios{
    private $nome;
    private $senha;
    private $email;
    private $tipo;
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
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
}