<?php
include "../../DAO/func_teacher.php";
$idNum = $_POST['idNum'];
$check = new teacher();
$check -> checkNSidNum($idNum);