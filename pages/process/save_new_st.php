<?php
include "../../DAO/func_teacher.php";
$data = $_POST['data'];
$decoded = json_decode($data, true);
$save = new teacher();
$save -> save_new_st($decoded);