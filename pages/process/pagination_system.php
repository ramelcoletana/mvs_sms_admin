<?php
/**
 * Created by JetBrains PhpStorm.
 * User: student1
 * Date: 5/6/13
 * Time: 3:21 PM
 * To change this template use File | Settings | File Templates.
 */
include "../../DAO/func_teacher.php";
$page = $_POST['page'];
$input_search_val = $_POST['input_search_val']."%";
$teacher_type = $_POST['teacher_type'];
$page_limit = $_POST['page_limit'];
$paginate = new teacher();
$paginate -> pagination_system($page, $input_search_val, $teacher_type, $page_limit);