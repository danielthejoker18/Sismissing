<?php

class IndexModel extends PersistModelAbstract
{
    private $in_id;
    private $st_fullName;
    private $st_shortName;
    private $st_logo;
    private $st_shortLogo;
    private $dt_create;
    private $dt_update;

    function __construct()
    {
        parent::__construct();
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
    public function getStFullName()
    {
        return $this->st_fullName;
    }

    /**
     * @param mixed $st_fullName
     */
    public function setStFullName($st_fullName)
    {
        $this->st_fullName = $st_fullName;
    }

    /**
     * @return mixed
     */
    public function getStShortName()
    {
        return $this->st_shortName;
    }

    /**
     * @param mixed $st_shortName
     */
    public function setStShortName($st_shortName)
    {
        $this->st_shortName = $st_shortName;
    }

    /**
     * @return mixed
     */
    public function getStLogo()
    {
        return $this->st_logo;
    }

    /**
     * @param mixed $st_logo
     */
    public function setStLogo($st_logo)
    {
        $this->st_logo = $st_logo;
    }

    /**
     * @return mixed
     */
    public function getStShortLogo()
    {
        return $this->st_shortLogo;
    }

    /**
     * @param mixed $st_shortLogo
     */
    public function setStShortLogo($st_shortLogo)
    {
        $this->st_shortLogo = $st_shortLogo;
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


    public function FirstAccess () {

        $st_query = "SELECT * FROM tbl_config WHERE in_id = 1;";

        if(!(mysqli_query($this->o_db,$st_query)))
        {
            return true;
        }

        if ($o_res = mysqli_fetch_assoc(mysqli_query($this->o_db,$st_query)))
        {
            $_SESSION['st_fullName'] = $o_res['st_fullName'];
            $_SESSION['st_shortName'] = $o_res['st_shortName'];
            $_SESSION['st_logo'] = $o_res['st_logo'];
            $_SESSION['st_shortLogo'] = $o_res['st_shortLogo'];
            return false;
        }
        return true;
    }

    public function loadOptionsName ($tbl, $where = '', $get = null)
    {
        $html = '<option></option>';

        $st_query = 'SELECT * FROM '.$tbl.' '.$where.';';

        try
        {
            $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
            while ($o_ret = mysqli_fetch_assoc($o_data))
            {
                $select = '';
                if ($o_ret['st_name'] == $get) {
                    $select = 'selected="selected"';
                }
                $html .= '<option value="'.$o_ret['st_name'].'" '.$select.' />'.$o_ret['st_name'];
            }
            return $html;
        }
        catch(PDOException $e)
        {}
        return $st_query;
    }

    public function save()
    {
        if(is_null($this->in_id))
            $st_query = "INSERT INTO tbl_config
                            (
                                st_fullName,
                                st_shortName,
                                st_logo,
                                st_shortLogo,
                                dt_create
                            )
                            VALUES
                            (
                                '$this->st_fullName',
                                '$this->st_shortName',
                                '$this->st_logo',
                                '$this->st_shortLogo',
                                NOW()
                            );";
        else
            $st_query = "UPDATE
                                tbl_config
                            SET
                                st_matricula = '$this->st_fullName',
                                st_name = '$this->st_shortName',
                                st_mail = '$this->st_logo',
                                st_password = '$this->st_shortLogo',
                                dt_create = NOW()
                            WHERE
                                in_id = $this->in_id";
        try
        {

            if($this->o_db->query($st_query) > 0)
                if(is_null($this->in_id))
                {
                    return $this->o_db->insert_id();
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


    public function delete()
    {
        if(!is_null($this->in_id))
        {
            $st_query = "DELETE FROM
                                tbl_config
                            WHERE in_id = $this->in_id";
            if($this->o_db->query($st_query) > 0)
                return true;
        }
        return false;
    }

}
