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

    /** --- Função para fazer o longin confirmando usuário no bando de dados --- **/
    public function fazerLogin()
    {
        /** --- Comando pesquisand o nome e senha para selecionar se os registros ja exite na tabela --- **/
        $sql = "SELECT * FROM usuarios WHERE nome = '$this->user' AND senha = '$this->pass' ";
        /** --- Como não vamos manipular nem filtar os dados podemos usar a query 
         * ao invés do prepare do statement --- **/
        $sql = $this->pdo->query($sql);
         
         /** --- contamos se alguma linha foi encontrada na pesquisa --- */
        if ($sql->rowCount() > 0) {
            /** --- Se encontrarmos registro ativamos a sesison --- **/
            $_SESSION['ativo'] = true;
            /** --- e setamos user como o usario encontrado --- **/
            $_SESSION['user'] = $this->user;
        }
        
    }

}