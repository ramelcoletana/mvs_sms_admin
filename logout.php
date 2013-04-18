<?php
session_start();
include "DAO/func_admin.php";
	$setS = new func_admin();
	if(isset($_SESSION['admin_username']) && isset($_SESSION['admin_password'])){
		session_destroy();
		session_unset();
		header("location: login.php");
	}