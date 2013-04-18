<?php
  
  class db_connect{
  
  		private $dbHost = 'mysql:host=localhost;';
  		private $dbName = 'dbname=mvs_sms_db';
  		private $username = "root";
  		private $password = "";
  		protected $dbCon = null;
  		
  		function openCon(){
  			
  			$this->dbCon = new PDO($this->dbHost.$this->dbName,$this->username,$this->password);
  		
  		}
  		
  		function closeCon(){
  		
  			$this->dbCon = null;
  		
  		}
  
  
  }
  


?>
