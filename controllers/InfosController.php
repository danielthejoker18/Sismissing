<?php

spl_autoload_register(function($st_class) {
    if(file_exists('models/'.$st_class.'.php'))
        require_once 'models/'.$st_class.'.php';
});

class InfosController extends PersistModelAbstract
{

    public function testeAction()
    {
        $o_Teste = new InfosModel();
        echo $o_Teste->testeFunction();

    }

    public function gravaAction()
    {
        $o_infos = new InfosModel();
        if(count($_POST) > 0){
          $o_infos->setInIdUser($_POST['in_id_user']);
          $o_infos->setInIdDesaparecido($_POST['in_id_desaparecido']);
          $o_infos->setStInfo($_POST['st_descricao']);
          if($o_infos->save()){
            $id = $o_infos->getInIdDesaparecido();
            Application::redirect('?ctrl=detalhes&act=view&id='.$id);
            return;
          }else{
            //Application::redirect('?ctrl=Detalhes&act=view&id='.$o_infos->getInIdDesaparecido());
            return;
          }
        }
        $o_Teste = new InfosModel();
        echo $o_Teste->testeFunction();
    }

}
