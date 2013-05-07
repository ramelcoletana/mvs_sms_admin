<?php
/**
 * Created by JetBrains PhpStorm.
 * User: student1
 * Date: 5/7/13
 * Time: 12:00 PM
 * To change this template use File | Settings | File Templates.
 */
include "../../DAO/func_teacher.php";
$teach_auto_id = $_POST['teach_auto_id'];
$del_one = new teacher();
$del_one -> delete_one_teacher($teach_auto_id);