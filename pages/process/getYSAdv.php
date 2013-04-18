<?php
include "../../DAO/func_teacher.php";
	$status = $_GET['status'];
	$get = new teacher();
	$get -> getYSAdv($status);