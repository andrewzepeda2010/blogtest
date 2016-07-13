<?php

class LogoutController extends Zend_Controller_Action
{
	private $session = null;
	private $model = null;
	
    public function init()
    {
        $this->session = new Zend_Session_Namespace('login');
        $this->view->assign("session", $this->session);
		
        $this->model = new Application_Model_Users();
    }

    public function indexAction()
    {
		$this->session->unsetAll();
		
		header("Location: /login");
		exit;
    }

}

