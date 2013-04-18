<?php
include "../../DAO/func_teacher.php";
	$data = $_POST['data'];
	$decoded = json_decode($data, true);
	
	foreach($decoded as $info){
		$$info['name'] = $info['value'];
	}