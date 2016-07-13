<?php

class AboutController extends Zend_Controller_Action
{
	private $session = null;

    public function init()
    {
        $this->session = new Zend_Session_Namespace('login');
        $this->view->assign("session", $this->session);
    }


    public function indexAction()
    {
        // action body
    }


}

