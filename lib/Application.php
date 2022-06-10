<?php

spl_autoload_register(function($st_class) {
    if(file_exists('lib/'.$st_class.'.php'))
        require_once 'lib/'.$st_class.'.php';
});

class Application
{
    protected $st_controller;

    protected $st_action;

    private function loadRoute()
    {

        $this->st_controller = isset($_REQUEST['ctrl']) ?  $_REQUEST['ctrl'] : 'Home';

        $this->st_action = isset($_REQUEST['act']) ?  $_REQUEST['act'] : 'LandPage';
        
    }

    public function dispatch()
    {
        $this->loadRoute();

        //verificando se o arquivo de controle existe
        $st_controller_file = 'controllers/'.$this->st_controller.'Controller.php';
        if(file_exists($st_controller_file))
            require_once $st_controller_file;
        else
            throw new Exception('Arquivo '.$st_controller_file.' nao encontrado');

        //verificando se a classe existe
        $st_class = $this->st_controller.'Controller';
        if(class_exists($st_class))
            $o_class = new $st_class;
        else
            throw new Exception("Classe '$st_class' nao existe no arquivo '$st_controller_file'");

        //verificando se o metodo existe
        $st_method = $this->st_action.'Action';
        if(method_exists($o_class,$st_method))
            $o_class->$st_method();
        else
            throw new Exception("Metodo '$st_method' nao existe na classe $st_class'");
    }

    static function redirect( $st_uri )
    {
        header("Location: $st_uri");
    }
}
