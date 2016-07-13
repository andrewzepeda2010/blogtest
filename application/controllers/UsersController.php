<?php

class UsersController extends Zend_Controller_Action
{
	private $session = null;
	private $model = null;

    public function init()
    {
        $this->session = new Zend_Session_Namespace('login');
        $this->view->assign("session", $this->session);
	
		$this->model = new Application_Model_Blogs();
    }


    public function indexAction()
    {
		$blogs = $this->model->getblogs(10);

		$this->view->assign("blogs", $blogs);
    }


}

