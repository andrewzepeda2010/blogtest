<?php

class RegisterController extends Zend_Controller_Action
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
		$request = $this->getRequest();
		if ($request->isPost()){
			$post = $request->getPost();
			$errorMessages = array();
			
			$validator = new Zend_Validate_EmailAddress();
			if (!$validator->isValid($post['email_address'])) {
				$errorMessages[] = "Email address is not valid.";
			}
			
			$validator = new Zend_Validate_Alnum();
			if (!$validator->isValid($post['username'])) {
				$errorMessages[] = "Username is not valid.";
			}
			
			$validator = new Zend_Validate_Alpha();
			if (!$validator->isValid($post['first_name'])) {
				$errorMessages[] = "First name is not valid.";
			}
			
			$validator = new Zend_Validate_Alpha();
			if (!$validator->isValid($post['last_name'])) {
				$errorMessages[] = "Last name is not valid.";
			}
			
			if ($post['cpassword'] != $post['vpassword']) {
				$errorMessages[] = "Passwords does not match.";
			}
			
			$emailexists = $this->model->checkemailifexists($post['email_address']);
			if (!empty($emailexists)) {
				$errorMessages[] = "Email already exists.";
			}
			
			if (empty($errorMessages)) {
				$result = $this->model->processregistration ($post);
				$this->_helper->viewRenderer->setNoRender();

			} 

		}
    }

}

