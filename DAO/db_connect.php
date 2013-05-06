<?php
  
  class db_connect{
  
  		private $dbHost = 'mysql:host=student1.e2ps;';
  		private $dbName = 'dbname=mvs_sms_db';
  		private $username = "student1";
  		private $password = "password";
  		protected $dbCon = null;
  		
  		function openCon(){
  			
  			$this->dbCon = new PDO($this->dbHost.$this->dbName,$this->username,$this->password);
  		
  		}
  		
  		function closeCon(){
  		
  			$this->dbCon = null;
  		
  		}
  
  
  }
  


?>
