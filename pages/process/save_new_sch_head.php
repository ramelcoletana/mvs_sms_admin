<?php
include "../../DAO/func_teacher.php";

	$data = $_POST['data'];
	$decoded = json_decode($data, true);
	
	foreach($decoded as $info){
		$$info['name'] = $info['value'];
	}
	$profilePic = "profile_pic_teachers/avatar.gif";

	$save = new teacher();
	$save -> save_new_sch_head($idNum,$fName,$mName,$lName,$address,$email,$mobile,$age,$gender,$bDate,$rank,$profilePic);
?>