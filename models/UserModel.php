<?php

class UserModel extends PersistModelAbstract
{
    private $in_id;
    private $st_name;
    private $st_mail;
    private $st_password;
    private $st_photo;
    private $dt_create;
    private $dt_update;

    function __construct()
    {
        parent::__construct();
        //executa método de criação da tabela de Usuários
        $this->createTableUsers();
    }

    /**
     * @return mixed
     */
    public function getInId()
    {
        return $this->in_id;
    }

    /**
     * @param mixed $in_id
     */
    public function setInId($in_id)
    {
        $this->in_id = $in_id;
    }

    /**
     * @return mixed
     */
    public function getStName()
    {
        return $this->st_name;
    }

    /**
     * @param mixed $st_name
     */
    public function setStName($st_name)
    {
        $this->st_name = $st_name;
    }

    /**
     * @return mixed
     */
    public function getStMail()
    {
        return $this->st_mail;
    }

    /**
     * @param mixed $st_mail
     */
    public function setStMail($st_mail)
    {
        $this->st_mail = $st_mail;
    }

    /**
     * @return mixed
     */
    public function getStPassword()
    {
        return $this->st_password;
    }

    /**
     * @param mixed $st_password
     */
    public function setStPassword($st_password)
    {
        $this->st_password = $st_password;
    }

    /**
     * @return mixed
     */
    public function getStPhoto()
    {
        return $this->st_photo;
    }

    /**
     * @param mixed $st_photo
     */
    public function setStPhoto($st_photo)
    {
        $this->st_photo = $st_photo;
    }

    /**
     * @return mixed
     */
    public function getDtCreate()
    {
        return $this->dt_create;
    }

    /**
     * @param mixed $dt_create
     */
    public function setDtCreate($dt_create)
    {
        $this->dt_create = $dt_create;
    }

    /**
     * @return mixed
     */
    public function getDtUpdate()
    {
        return $this->dt_update;
    }

    /**
     * @param mixed $dt_update
     */
    public function setDtUpdate($dt_update)
    {
        $this->dt_update = $dt_update;
    }

    public function loadById( $in_id )
    {
        $st_query = "SELECT * FROM tbl_users WHERE in_id = $in_id;";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
        $o_ret = mysqli_fetch_assoc($o_data);
        $this->setInId($o_ret['in_id']);
        $this->setStName($o_ret['st_name']);
        $this->setStMail($o_ret['st_mail']);
        $this->setStPassword($o_ret['st_password']);
        $this->setStPhoto($o_ret['st_photo']);
        $this->setDtCreate($o_ret['dt_create']);
        $this->setDtUpdate($o_ret['dt_update']);

        return $this;
    }

    public function checkMatricula($st_mail)
    {
        $st_query = "SELECT * FROM tbl_users WHERE `st_mail` = '$st_mail';";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
        if ($o_ret = mysqli_fetch_assoc($o_data))
        {
            return true;
        }
        return false;
    }

    /**
     * @throws PDOException
     * @return integer
     */
    public function save()
    {
        if(is_null($this->in_id))
            $st_query = "INSERT INTO tbl_users
                            (
                                st_name,
                                st_mail,
                                st_password,
                                st_photo,
                                dt_create
                            )
                            VALUES
                            (
                                '$this->st_name',
                                '$this->st_mail',
                                '$this->st_password',
                                '$this->st_photo',
                                NOW()
                            );";
        else
            $st_query = "UPDATE
                                tbl_users
                            SET
                                st_name = '$this->st_name',
                                st_mail = '$this->st_mail',
                                st_password = '$this->st_password',
                                st_photo = '$this->st_photo',
                                dt_update = NOW()
                            WHERE
                                in_id = $this->in_id";
        try
        {

            if($this->o_db->query($st_query) > 0)
                if(is_null($this->in_id))
                {
                    return $this->o_db->insert_id;
                }
                else
                {
                    return $this->in_id;
                }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $st_query;
    }

    /**
     * Deleta os dados persistidos na tabela de
     * contato usando como referencia, o id da classe.
     */
    public function delete()
    {
        if(!is_null($this->in_id))
        {
            $st_query = "DELETE FROM
                                tbl_users
                            WHERE in_id = $this->in_id";
            if($this->o_db->query($st_query) > 0)
                return true;
        }
        return false;
    }

    /**
     * @throws PDOException
     */
    private function createTableUsers()
    {
        $st_query = "CREATE TABLE IF NOT EXISTS tbl_users
                        (
                            in_id INTEGER NOT NULL AUTO_INCREMENT,
                            st_name VARCHAR(255) NOT NULL,
                            st_mail VARCHAR(255) NOT NULL,
                            st_password VARCHAR(255) NOT NULL,
                            st_photo VARCHAR(255) NOT NULL DEFAULT 'default.png',
                            dt_create DATETIME,
                            dt_update DATETIME,
                            PRIMARY KEY(in_id)
                        )";

        //executando a query;
        try
        {
            $this->o_db->query($st_query);
        }
        catch(PDOException $e)
        {
            throw $e;
        }
    }

}
