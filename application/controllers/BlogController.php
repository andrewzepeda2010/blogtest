<?php

class BlogController extends Zend_Controller_Action
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

    }
	
    public function commentAction()
    {
		
		$request = $this->getRequest();
		if ($request->isPost()){
			$post = $request->getPost();
			$errorMessages = array();

			if (empty($errorMessages)) {
				$post['user_id'] = $this->session->id;
				$post['slug'] = $this->slugify($post['title']);
				
				$result = $this->model->saveblog ($post);
				echo json_encode($errorMessages);
			} else {
				echo json_encode($errorMessages);
			}
			
			$this->_helper->viewRenderer->setNoRender();
		}
		
		$id = $this->getParam("id");
		$blog = $this->model->getblog($id);
		$this->view->assign("blog", $blog[0]);
    }
	
    public function postAction()
    {
		$id = $this->getParam("id");
		$blog = $this->model->getblog($id);
		
		$this->view->assign("blog", $blog[0]);
    }	
	
    public function postsAction()
    {
		$blogs = $this->model->getblogs(10);

		$this->view->assign("blogs", $blogs);
    }
	
    public function createAction()
    {
		$request = $this->getRequest();
		if ($request->isPost()){
			$post = $request->getPost();
			$errorMessages = array();

			if (empty($errorMessages)) {
				$post['user_id'] = $this->session->id;
				$post['slug'] = $this->slugify($post['title']);
				
				$result = $this->model->saveblog ($post);
				echo json_encode($errorMessages);
			} else {
				echo json_encode($errorMessages);
			}
			
			$this->_helper->viewRenderer->setNoRender();
		}
    }
	
	function slugify($text)
	{

	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  $text = preg_replace('~[^-\w]+~', '', $text);

	  $text = trim($text, '-');

	  $text = preg_replace('~-+~', '-', $text);

	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
}

