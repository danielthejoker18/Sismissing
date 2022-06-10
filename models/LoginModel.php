<?php
session_start();

class LoginModel extends PersistModelAbstract
{
    private $st_mail;
    private $st_password;

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

    public function checkUser($st_mail)
    {
        $st_query = "SELECT * FROM tbl_users WHERE st_mail = '$st_mail';";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
        if (mysqli_fetch_assoc($o_data))
        {
            return 'done';
        }
        return 'erro';
    }


    public function login()
    {
        $st_query = "SELECT * FROM tbl_users WHERE st_mail = '$this->st_mail' AND st_password = '$this->st_password';";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
        if ($o_ret = mysqli_fetch_assoc($o_data))
        {
            $_SESSION['in_id'] = $o_ret['in_id'];
            $_SESSION['st_name'] = $o_ret['st_name'];
            $_SESSION['st_mail'] = $o_ret['st_mail'];
            $_SESSION['st_photo'] = $o_ret['st_photo'];
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['host'] = gethostbyaddr($_SESSION["ip"]);
            $_SESSION['accesstime'] = time();

            return 'done';
        }
        return $st_query;
    }

    public function checkPassword()
    {
        $st_query = "SELECT * FROM tbl_users WHERE st_mail = '$this->st_mail' AND st_password = '$this->st_password';";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
        if ($o_ret = mysqli_fetch_assoc($o_data))
        {
            $_SESSION['accesstime'] = time();

            return 'done';
        }
        return $st_query;
    }

    public function getsystem_url()
    {
        $st_query = "SELECT * FROM tbl_config WHERE in_id = 1;";
        $o_data = mysqli_query($this->o_db,$st_query) or die("Erro");
        if ($o_ret = mysqli_fetch_assoc($o_data))
        {
            return $o_ret['st_url'];
        }
        return '';
    }

    public function checkLogin()
    {
        $session_time = 9000;

        if (empty($_SESSION['system_url']))
        {
            $_SESSION['system_url'] = self::getsystem_url();
        }

        if (empty($_SESSION['in_id']))
        {
            return false;
        }

        if ($_SESSION['accesstime'] + $session_time > time()) {
            $_SESSION['accesstime'] = time();
            return 'log';
        }

        return 'lock';
    }

    public function logout()
    {
        session_destroy();
        return true;
    }
}
