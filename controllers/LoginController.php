<?php
require_once "models/LoginModel.php";

class LoginController
{

    public function loginAction()
    {

        // Check Login
        $o_login = new LoginModel();
        if ($o_login->checkLogin() == true) {
            Application::redirect('?ctrl=Home&act=LandPage');
            return;
        }
        if($o_login->checkLogin() == 'lock')
        {
            Application::redirect('?ctrl=Login&act=lockscreen');
            return;
        }

        if (count($_POST) > 0)
        {
            $o_login = new LoginModel();

            $o_login->setStMail(DataFilter::cleanString($_POST['st_mail']));
            $o_login->setStPassword(DataFilter::cleanString(md5($_POST['st_password'])));
            if ($o_login->login() == 'done')
            {
                Application::redirect('?ctrl=Home&act=LandPage');
                return;
            }

            echo 'Erro ao realizar LOGIN';
        }

        $o_view = new View('views/site/User/loginPage.phtml');
        $o_view->setParams(
            array(
                'pageTitle' => 'Login'
            ));
        $o_view->showContents();
    }

    public function checkLoginAction()
    {
        $o_login = new LoginModel();

        if ($o_login->checkLogin() == false) {
            Application::redirect('?ctrl=Login&act=login');
            return;
        }
        return true;
    }

    public function logoutAction()
    {
        $o_login = new LoginModel();
        if($o_login->logout()){
            Application::redirect('?ctrl=Login&act=login');
            return;
        }

        Application::redirect('?ctrl=Home&act=LandPage');
    }

    public function lockscreenAction()
    {
        if (count($_POST) > 0)
        {
            echo 'post';
            $o_login = new LoginModel();

            $o_login->setStMail(DataFilter::cleanString($_SESSION['st_mail']));
            $o_login->setStPassword(DataFilter::cleanString(md5($_POST['st_password'])));

            if ($o_login->checkPassword() == 'done')
            {
                Application::redirect('?ctrl=Home&act=LandPage');
                return;
            }

            echo 'Erro ao realizar LOGIN';
        }

        $o_view = new View('views/site/lockscreen.phtml');
        $o_view->setParams(
            array(
                'pageTitle' => 'Lockscreen'
            ));
        $o_view->showContents();
    }

}
