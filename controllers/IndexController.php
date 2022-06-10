<?php

spl_autoload_register(function($st_class) {
    if(file_exists('models/'.$st_class.'.php'))
        require_once 'models/'.$st_class.'.php';
});

class IndexController
{
    public function indexAction()
    {


        // Check First Access
        $o_index = new IndexModel();
        if ($o_index->FirstAccess() == true)
        {
            $o_Chat = new ChatModel();
            $o_login = new LoginModel();
            $o_User = new UserModel();

            // Configuração Inicial do Aplicativo
            self::configAction();
        }

        // Check Login
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

        // Redirect to Dashboard
        Application::redirect('?ctrl=Home&act=LandPage');
        echo 'landpage';
    }

    public function configAction()
    {

        // Redirect to Config Page.
        $o_view = new View('views/site/FirstAccess/index.phtml');
        $o_view->setParams(
            array(
                'pageTitle' => 'Configuração Inicial'
            ));
        $o_view->showContents();

    }

    public function updatedbAction()
    {
        $o_Chat = new ChatModel();
        $o_login = new LoginModel();
        $o_User = new UserModel();

        // Redirect to Dashboard
        Application::redirect('?ctrl=Home&act=LandPage');
    }
}
