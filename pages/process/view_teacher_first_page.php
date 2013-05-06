<?php
/**
 * Created by JetBrains PhpStorm.
 * User: student1
 * Date: 5/6/13
 * Time: 12:08 PM
 * To change this template use File | Settings | File Templates.
 */

include "../../DAO/func_teacher.php";
$search_input_val = $_POST['search_input'];
$teacher_type = $_POST['teacher_type'];
$page_limit = $_POST['page_limit'];
$view = new teacher();
$view -> view_teacher_first_page($search_input_val, $teacher_type, $page_limit);