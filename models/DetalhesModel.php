<?php

class DetalhesModel extends PersistModelAbstract
{
    private $in_id;
    private $st_nome;
    private $in_idade;
    private $st_descricao;
    private $data_cadastro;
    private $data_desaparecimento;
    private $st_foto;

    public function getId()
    {
      return $this->in_id;
    }

    public function setId($in_id)
    {
      return $this->in_id = $in_id;
    }

    public function getName()
    {
      return $this->st_nome;
    }

    public function setName($st_name)
    {
      return $this->st_nome = $st_name;
    }

    public function getIdade()
    {
      return $this->in_idade;
    }

    public function setIdade($in_idade)
    {
      return $this->in_idade = $in_idade;
    }

    public function getDescricao()
    {
      return $this->st_descricao;
    }

    public function setDescricao($st_descricao)
    {
      return $this->st_descricao = $st_descricao;
    }

    public function getDataCad()
    {
      return $this->data_cadastro;
    }

    public function setDataCad($data_cad)
    {
      return $this->data_cadastro = $data_cad;
    }

    public function getDataDesap()
    {
      return $this->data_desaparecimento;
    }

    public function setDataDesap($data_desap)
    {
      return $this->data_desaparecimento = $data_desap;
    }

    public function getFoto()
    {
      return $this->st_foto;
    }

    public function setFoto($st_foto)
    {
      return $this->st_foto = $st_foto;
    }

    function __construct($id)
    {
        parent::__construct();
        self::getDados($id);
    }

    public function getDados($id)
    {
      try
      {
        $st_query = "SELECT * FROM tbl_desaparecidos where in_id like '$id'";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro". $st_query);
        while($o_ret = mysqli_fetch_assoc($o_data))
        {
          $o_date = strtotime($o_ret['data_desaparecimento']);
          $data = date( 'd-m-Y', $o_date );
          $novaData = str_replace("-","/",$data);
          $o_dateCad = strtotime($o_ret['data_cadastro']);
          $dataCad = date('d-m-Y', $o_dateCad);
          $novaDataCad = str_replace("-","/", $dataCad);
          $this->in_id = $o_ret['in_id'];
          $this->st_nome = $o_ret['st_nome'];
          $this->in_idade = $o_ret['in_idade'];
          $this->st_descricao = $o_ret['st_descricao'];
          $this->data_cadastro = $novaDataCad;
          $this->data_desaparecimento = $novaData;
          $this->st_foto = $o_ret['st_foto'];
        }

      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    }
}
