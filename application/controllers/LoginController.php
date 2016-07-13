<?php

class LoginController extends Zend_Controller_Action
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

			
			if (empty($errorMessages)) {
				$result = $this->model->checklogincredentials ($post);
				$response = 0;
				
				if (!empty($result)) {
                    $session = new Zend_Session_Namespace('login');
					$session->setExpirationSeconds(3600);
					
                    $session->id = $result[0]['id'];
                    $session->username = $result[0]['username'];
					$response = $this->session->id;
				}
					
				echo json_encode($response);
				$this->_helper->viewRenderer->setNoRender();
			} else {
				$this->view->assign("errorMessages", $errorMessages);
			}
			
		}
    }

}

