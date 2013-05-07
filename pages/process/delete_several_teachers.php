<?php
/**
 * Created by JetBrains PhpStorm.
 * User: student1
 * Date: 5/7/13
 * Time: 10:57 AM
 * To change this template use File | Settings | File Templates.
 */
include "../../DAO/func_teacher.php";
$dataArr = $_POST['dataArr'];
$del_sev = new teacher();
$del_sev -> delete_several_teachers($dataArr);