<?php

class Application_Model_Users
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = Zend_Controller_Front::getInstance()->getParam('bootstrap')->conn;
    }
	
	
	public function checklogincredentials($data) {
		
		$select = $this->conn->select()->from("users");
		$select->where('email_address LIKE ?', $data['email_address']);
		$select->where('password = ?', md5($data['cpassword']));
		$records = $select->query()->fetchAll();
		
        return $records;				
	}
	
	public function checkemailifexists($email) {
		
		$select = $this->conn->select()->from("users");
		$select->where('email_address = ?', $email);
		$records = $select->query()->fetchAll();
		
        return $records;				
	}
	
	
	public function processregistration($data) {
		$data = array(
			'username'      	=> $data['username'],
			'password' 			=> md5($data['cpassword']),
			'email_address'		=> $data['email_address'],
			'first_name'		=> $data['first_name'],
			'last_name'			=> $data['last_name'],
			'created_at'		=> date("Y-m-d H:i:s"),
			'updated_at'		=> date("Y-m-d H:i:s")
		);
		 
		$un = $this->conn->insert('users', $data);
		
		return $un;
	}
}

