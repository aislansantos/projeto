<?php
class Filial
{
    private $id;
    private $nome;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function setId($i)
    {
        $this->id = $i;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($n)
    {
        $this->nome = $n;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function listaGeral()
    {
        $sql = "SELECT * FROM filiais";
        $sql = $this->pdo->query($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        } else {
            return array();
        }
    }
}
