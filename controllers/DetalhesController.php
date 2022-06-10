<?php

spl_autoload_register(function($st_class) {
    if(file_exists('models/'.$st_class.'.php'))
        require_once 'models/'.$st_class.'.php';
});

class DetalhesController extends PersistModelAbstract
{

    public function testeAction()
    {
        $o_Teste = new DetalhesModel();
        echo $o_Teste->testeFunction();

    }

    public function editAction()
    {
      $o_infos = new InfosModel();
      if(count($_POST) > 0){
        $in_id_user = $_POST['in_id_user'];
        $in_id_desaparecido = $_POST['in_id_desaparecido'];
        $st_descricao = $_POST['st_descricao'];
        $o_infos->setInIdUser($in_id_user);
        $o_infos->setInIdDesaparecido($in_id_desaparecido);
        $o_infos->setStInfo($st_descricao);
        if($o_infos->save()){;
          Application::redirect('?ctrl=detalhes&act=view&id='.$in_id_desaparecido);
          return;
        }else{
          Application::redirect('?ctrl=detalhes&act=view&id='.$in_id_desaparecido);
          return;
        }
      }

        $o_view = new View('views/site/detalhes/index.phtml');
        $o_view->setParams(
            array(
                'pageTitle' => 'Detalhes Edição'
            ));
        $o_view->showContents();

    }

    public function viewAction()
    {

        $o_view = new View('views/site/detalhes/view.phtml');
        $o_view->setParams(
            array(
                'pageTitle' => 'Detalhes Visualização'
            ));
        $o_view->showContents();

    }

}
