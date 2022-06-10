<?php

class View
{
    private $st_contents;
    private $st_view;
    private $v_params;

    function __construct($st_view = null, $v_params = null)
    {
        if($st_view != null)
        {
            $this->setView($st_view);
        }
        $this->v_params = $v_params;
    }

    public function setView($st_view)
    {

        if(file_exists($st_view))
        {
            $this->st_view = $st_view;
        } else {
            throw new Exception("View File '$st_view' don't exists");
        }
    }


    public function getView()
    {
        return $this->st_view;
    }


    public function setParams(Array $v_params)
    {
        $this->v_params = $v_params;
    }


    public function getParams()
    {
        return $this->v_params;
    }


    public function getContents()
    {
        ob_start();
        if(isset($this->st_view))
          require_once $this->st_view;
        $this->st_contents = ob_get_contents();
          ob_end_clean();
        return $this->st_contents;
    }

    public function showContents()
    {
        echo $this->getContents();
        exit;
    }

}
