<?php

class Application_Model_Blogs
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = Zend_Controller_Front::getInstance()->getParam('bootstrap')->conn;
    }

	
	public function savecomment($data) {
		$data = array(
			'blog_id'			=> $data['blog_id'],
			'content'			=> $data['content'],
			'created_at'		=> date("Y-m-d H:i:s"),
			'updated_at'		=> date("Y-m-d H:i:s")
		);
		 
		$un = $this->conn->insert('comments', $data);
		
		return $un;
	}
	
	public function getblog($id) {
		
		$query = "SELECT * FROM `blogs` AS `b` LEFT JOIN `users` AS `u` ON u.id = b.user_id WHERE b.id = '$id'";
		$records = $this->conn->fetchAll($query);

        return $records;				
	}

	
	public function getblogs($limit) {
		
		$query = "SELECT * FROM `blogs` AS `b` LEFT JOIN `users` AS `u` ON u.id = b.user_id LIMIT $limit";
		$records = $this->conn->fetchAll($query);

        return $records;				
	}

	
	
	public function saveblog($data) {
		$data = array(
			'user_id'			=> $data['user_id'],
			'title'      		=> $data['title'],
			'content'			=> $data['content'],
			'slug'				=> $data['slug'],
			'created_at'		=> date("Y-m-d H:i:s"),
			'updated_at'		=> date("Y-m-d H:i:s")
		);
		 
		$un = $this->conn->insert('blogs', $data);
		
		return $un;
	}
}

