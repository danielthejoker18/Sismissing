<?php

class Desaparecidos extends PersistModelAbstract
{
    private $in_id;
    private $st_nome;
    private $in_idade;
    private $st_foto;
    private $st_ocorrencia;
    private $st_informacaoDesaparecido;

    function imprimeCarrossel()
    {
      try
      {
          $st_query = "SELECT * FROM tbl_desaparecidos order by data_desaparecimento desc limit 100";
          $o_data = mysqli_query($this->o_db,$st_query) or die("Erro". $st_query);
          $counter = 0;
          while($o_ret = mysqli_fetch_assoc($o_data))
          {
            $class = $counter==0?'active':'';
            $counter++;
            $o_date = strtotime($o_ret['data_desaparecimento']);
            $data = date( 'd-m-Y', $o_date );
            $novaData = str_replace("-","/",$data);
            $html .= '<div class="carousel-item '.$class.'">
              <img class="first-slide" src="'.$o_ret['st_foto'].'/'.$o_ret['in_id'].'/1366/500" alt="First slide">
              <div class="container">
                <div class="carousel-caption text-right">
                  <h1>'.$o_ret['st_nome'].' - '.$novaData.'</h1>
                  <p>'.$o_ret['st_descricao'].'</p>
                  <p><a class="btn btn-lg btn-primary"  href="?ctrl=detalhes&act=edit&id='.$o_ret['in_id'].'" role="button">Forneça Informações <i class="bi bi-plus-circle"></i></a> <a class="btn btn-lg btn-light" href="?ctrl=detalhes&act=view&id='.$o_ret['in_id'].'" role="button">Informações <i class="bi bi-info-circle"></i></a></p>
                </div>
              </div>
            </div>';
          }
          echo $html;
      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }

    }

    function imprimeIndicador()
    {
      for($i=0;$i<100;$i++){
        $class = $i==0?'active':"";
        $html .= '<li data-target="#carrossel" data-slide-to="'.$i.'" class="'.$class.'"></li>';
      }
      echo $html;
    }
}
