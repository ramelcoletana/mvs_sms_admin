<?php
include "../DAO/func_admin.php";
	$dateLL = $_POST['dateLL'];
	$set = new func_admin();
	$set -> setLastLogin($dateLL);