<?php
include "../DAO/func_admin.php";
	$status = $_POST['status'];
	$view = new func_admin();
	$view->viewLatesEvent($status);