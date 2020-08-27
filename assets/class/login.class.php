<?php
Class Login{
    private $user;
    private $pass;
    private $email;
    private $tipo;
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

/* Métodos de Getters e Setters das variaveis privadas */
    public function getUser()
    {
        return $this->user;
    }
    public function setUser($u)
    {
        $this->user = $u;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function setPass($p)
    {
        $this->pass = $p;
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

    public function fazerLogin()
    {
        $sql = "SELECT * FROM usuarios WHERE nome = '$this->user' AND senha = '$this->pass' ";
        $sql = $this->pdo->query($sql);
         
        if ($sql->rowCount() > 0) {
            $_SESSION['ativo'] = true;
            $_SESSION['user'] = $this->user;
        }
        
    }

}