<?php
require_once "models/LoginModel.php";

class HomeController
{
    public function LandPageAction() {
        $o_login = new LoginModel();
        if ($o_login->checkLogin() == false) {
            Application::redirect('?ctrl=Login&act=login');
            return;
        }
        if($o_login->checkLogin() == 'lock')
        {
            Application::redirect('?ctrl=Login&act=lockscreen');
            return;
        }

        $o_view = new View('views/site/index.phtml');
        $o_view->setParams(
            array(
                'count_users' => 50,
                'pageTitle' => 'Sismissing - Home Page'
            ));
        $o_view->showContents();
    }

    public function viewAction() {

        $o_view = new View('views/site/Home/view.phtml');
        $o_view->setParams(
            array(
                'id_oco' => $_REQUEST['in_id'],
                'pageTitle' => 'Sismissing - Visualização'
            ));
        $o_view->showContents();
    }

}
