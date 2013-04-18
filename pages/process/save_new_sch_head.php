<?php
include "../../DAO/func_teacher.php";

	$data = $_POST['data'];
	$decoded = json_decode($data, true);
	
	foreach($decoded as $info){
		$$info['name'] = $info['value'];
	}
	$fullName = $fName." ".$mName." ".$lName;
	$profilePic = "profile_pic_teachers/avatar.gif";

	$save = new teacher();
	$save -> save_new_sch_head($idNum,$fullName,$address,$email,$mobile,$age,$gender,$bDate,$rank,$profilePic);
?>