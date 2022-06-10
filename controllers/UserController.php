<?php
require_once "models/UserModel.php";
require_once "models/LoginModel.php";

class UserController
{


    public function profileAction() {
        $o_login = new LoginModel();
        if ($o_login->checkLogin() == false) {
            Application::redirect('?ctrl=Login&acao=login');
            return;
        }
        if($o_login->checkLogin() == 'lock')
        {
            Application::redirect('?ctrl=Login&act=lockscreen');
            return;
        }

        $o_User = new UserModel();
        $o_user = $o_User->loadById(1);

        $o_view = new View('views/site/User/profile.phtml');
        $o_view->setParams(
            array(
                'v_users' => $o_user,
                'pageTitle' => 'Perfil do Usuário'
            ));
        $o_view->showContents();
    }

    public function listUsersAction()
    {
        $o_login = new LoginModel();
        if ($o_login->checkLogin() == false) {
            Application::redirect('?ctrl=Login&acao=login');
            return;
        }
        if($o_login->checkLogin() == 'lock')
        {
            Application::redirect('?ctrl=Login&act=lockscreen');
            return;
        }

        $o_User = new UserModel();

        //Listando os contatos cadastrados
        //$v_users = $o_User->_listUsers();

        $o_view = new View('views/site/User/listUsers.phtml');

        //Passando os dados do contato para a View
        $o_view->setParams(array(
            'pageTitle' => 'Lista de Usuários'));

        //Imprimindo código HTML
        $o_view->showContents();
    }

    /**
     * Gerencia a requisiçães de criação
     * e edição dos USUÁRIOS
     */
    public function addUserAction()
    {

        $o_user = new UserModel();

        //verificando se o id do usuario foi passado
        if( isset($_REQUEST['$in_id']) )
            //verificando se o id passado é valido
            if( DataValidator::isNumeric($_REQUEST['$in_id']) )
                //buscando dados do contato
                $o_user->loadById($_REQUEST['$in_id']);

        if(count($_POST) > 0)
        {

            if (!empty($_REQUEST['in_id']))
            {
                $o_user->setInId(DataFilter::cleanString($_REQUEST['in_id']));
            }

            if ($o_user->checkMatricula($_POST['st_mail']) == true)
            {
                return 'Este e-mail já está cadastrado no sistema!';
            }

            $o_user->setStName(DataFilter::cleanString($_POST['st_name']));
            $o_user->setStMail(DataFilter::cleanString($_POST['st_mail']));
            $o_user->setStPassword(DataFilter::cleanString(md5($_POST['st_password'])));
            $o_user->setStPhoto(DataFilter::cleanString('default.png'));
            //salvando dados e redirecionando para a lista de contatos
            if($o_user->save() > 0)
            {
                Application::redirect('?ctrl=Login&act=login');
                return;
            }

            echo $o_user->save();
        }

        $o_view = new View('views/site/User/createUser.phtml');
        $o_view->setParams(array('o_users' => $o_user));
        $o_view->showContents();
    }
}
