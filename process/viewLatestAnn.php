<?php
include "../DAO/func_admin.php";
	$status = $_POST['status'];
	$latest = new func_admin();
	$latest -> viewLatestAnn($status);