<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public $dbparams = array();
    public $conn = null;
	
    protected function _initMysql() {
        $this->bootstrap('db');
        $this->dbparams = $this->getPluginResource('db')->getParams();
        $this->connect();
    }
	
    function connect(){

        $this->conn = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host'     => $this->dbparams['host'],
            'username' => $this->dbparams['username'],
            'password' => $this->dbparams['password'],
            'dbname'   => $this->dbparams['dbname'],
        ));
    }
	
}

