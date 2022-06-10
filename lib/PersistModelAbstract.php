<?php

abstract class PersistModelAbstract
{

    protected $o_db;

    function __construct()
    {
        //Inicio de conexão com MySQL
        $st_host = '127.0.0.1';
        $st_banco = 'Sismissing';
        $st_usuario = 'root';
        $st_senha = '';
        $st_port = '3306';

        // Conecta-se ao banco de dados MySQL
        $this->o_db = mysqli_connect($st_host, $st_usuario, $st_senha, $st_banco, $st_port);

        // Caso algo tenha dado errado, exibe uma mensagem de erro
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());


        // Create connection
//        $conn = new mysqli($servername, $username, $password, $dbname);
        $this->o_db = new mysqli($st_host, $st_usuario, $st_senha, $st_banco);
		$this->o_db->set_charset("utf8");

        // Check connection
        if ($this->o_db->connect_error) {
            die("Connection failed: " . $this->o_db->connect_error);
        }

    }
}
