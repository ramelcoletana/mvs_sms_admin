<?php
include "../../DAO/func_teacher.php";
	$data1 = $_POST['data1'];
	$data2 = $_POST['data2'];
	$decoded1 = json_decode($data1, true);
	$decoded2 = json_decode($data2, true);
	/*$arrayData1 = array();
	$arrayData2 = array();
	foreach($decoded1 as $info1){
		array_push($arrayData1, "'".$info1['value']."'");
	}
	
	foreach($decoded2 as $info2){
		array_push($arrayData2, "'".$info2['value']."'");
	}
	$arrImplode1 = implode(",", $arrayData1);
	$arrImplode2 = implode(",", $arrayData2);*/
	$profilePic = "profile_pic_teachers/avatar.gif";
	$teacherType = "Adviser";
	$save = new teacher();
	$save -> save_new_adv($decoded1,$decoded2,$teacherType,$profilePic);