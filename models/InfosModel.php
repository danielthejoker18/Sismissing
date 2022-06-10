<?php
require_once "models/UserModel.php";

class InfosModel extends PersistModelAbstract
{
    private $in_id;
    private $st_info;
    private $in_id_desaparecido;
    private $in_id_user;
    private $st_data_cadastro;

    function __construct()
    {
        parent::__construct();
        //executa método de criação da tabela de Usuários
    }

    /**
     * @return mixed
     */
    public function getInIdDesaparecido()
    {
        return $this->in_id_desaparecido;
    }

    /**
     * @param mixed $in_id
     */
    public function setInIdDesaparecido($in_id_desaparecido): void
    {
        $this->in_id_desaparecido = $in_id_desaparecido;
    }

    /**
     * @return mixed
     */
    public function getStInfo()
    {
        return $this->st_info;
    }

    /**
     * @param mixed $in_idComunicadoInicial
     */
    public function setStInfo($st_info): void
    {
        $this->st_info = $st_info;
    }

    /**
     * @return mixed
     */
    public function getInUser()
    {
        return $this->in_id_user;
    }

    /**
     * @param mixed $in_idMedico
     */
    public function setInIdUser($in_id_user): void
    {
        $this->in_id_user = $in_id_user;
    }


    public function save()
    {
        if(!is_null($this->in_id_desaparecido)){
            $st_query = "INSERT INTO tbl_Informacoes
                            (
                                st_informacao,
                                in_id_desaparecido,
                                in_id_informante,
                                data_criacao
                            )
                            VALUES
                            (
                                '$this->st_info',
                                '$this->in_id_desaparecido',
                                '$this->in_id_user',
                                NOW()
                            );";
                          }
        try
        {

            $this->o_db->query($st_query);

        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $st_query;
    }



    /**
     * @throws PDOException
     */


    public function showInfos($in_id)
    {
        $o_User = new UserModel();
        $messages = '';
        $st_query = "SELECT * FROM tbl_Informacoes i join tbl_users u on u.in_id = in_id_informante WHERE in_id_desaparecido = $in_id order by data_criacao asc;";
        if ($o_data = mysqli_query($this->o_db,$st_query))
        {

            while ($o_ret = mysqli_fetch_assoc($o_data))
            {
              $o_date = strtotime($o_ret['data_criacao']);
              $data = date( 'd-m-Y', $o_date );
              $novaData = str_replace("-","/",$data);
                $messages .= '
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">'.$o_ret['st_name'].'</span>
                        <span class="direct-chat-timestamp float-right">'.$novaData.'</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="/Sismissing/assets/img/user1.png" alt="message user image">
					<!-- /.direct-chat-img -->
                    <div class="direct-chat-text">'.$o_ret['st_informacao'].'</div>
                </div>';
            }
        }
        return $messages;
    }

    public function testeFunction(){
      return "Funcionando!";
    }
}
