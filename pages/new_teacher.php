<?php
session_start();
include "../DAO/func_admin.php";

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['admin_password'])){
		header("location: ../login.php");
	}else{
		$name = new func_admin();
		$n = $name->get_admin_name($_SESSION['admin_username'],$_SESSION['admin_password']);
		$_SESSION['admin_name'] = $n;
		$pic = $name->get_admin_pic($_SESSION['admin_username'],$_SESSION['admin_password']);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="programmer_r" />
<title>MVS &raquo; ADMIN | New Teacher</title>
<link rel="icon" href="../img/sms.ico"/>

<link rel='stylesheet' type='text/css' href='../themes/base/jquery.ui.all.css'/>
<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/navi.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/form_layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/new_teacher.css" media="screen" />

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js-ui/jquery-ui-darkhive.js"></script>
<script type="text/javascript" src="../js/current_date.js"></script>
<script type="text/javascript" src="js/new_teacher.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#teachers").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
</head>
<body>
<div class="wrap">
	<div id="header">
		<div id="top">
			<div class="left">
				<div style="position: absolute; border: 0 none; width: 22px; height: 22px; ">
					<img src=" <?php if(isset($pic)){ echo "../".$pic; }else{ echo "../img/avatar.gif";} ?>" 
					style="width: 20px; height: 20px; border: 0 none; margin: 0 auto; border-radius: 2px;"/>
				</div>
				<p style="margin-left: 33px;">Welcome, <strong id='admin_name'>
					<?php
						echo $_SESSION['admin_name'];
					?>
				</strong> [ <a href="../logout.php" id="a_logout">logout</a> ]
				Current date: &nbsp;<span class="c_date_time"></span><span class="cur_meridiem"></span>
				</p>
			</div>
			<div class="right">
				<div class="align-right">
                    <p>Last login: <strong class="date_time_last_login">
                            <?php
                            $date = new func_admin();
                            $d = $date->get_date_last_login($_SESSION['admin_username'],$_SESSION['admin_password']);
                            echo $d;
                            ?>
                        </strong>&nbsp;&nbsp;
                        S.Y.:<strong class='school_year'>
                            <?php
                            $sy = new func_admin();
                            $s = $sy->get_school_year();
                            echo $s;
                            ?>
                        </strong>
                    </p>
				</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<li class="upp"><a href="../index.php">Home</a></li>
				<li class="upp"><a href="#" class="current">Teachers</a>
					<ul>
						<li>&#8250; <a href="new_teacher.php" class="current">New Teacher</a></li>
						<li>&#8250; <a href="manage_teachers.php">Manage Teachers</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Staff</a>
					<ul>
						<li>&#8250; <a href="">Manage Staff</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Students</a>
					<ul>
						<li>&#8250; <a href="">New Student</a></li>
						<li>&#8250; <a href="">Manage Students</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Graduates</a>
					<ul>
						<li>&#8250; <a href="">View All</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Year & Section</a>
					<ul>
						<li>&#8250; <a href="">Add Yr. & Section</a></li>
						<li>&#8250; <a href="">Manage Yr. & Sec.</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Announcements</a>
					<ul>
						<li>&#8250; <a href="">New announcement</a></li>
						<li>&#8250; <a href="">Manage announcements</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Other</a>
					<ul>
						<li>&#8250; <a href="">Events</a></li>
						<li>&#8250; <a href="">Mission & Vision</a></li>
						<li>&#8250; <a href="">Gallery</a></li>
						<li>&#8250; <a href="">Admin Profile</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	
	<div id="content">
		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250;<a href="../index.php" class="home_nav">Home</a></div>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Teachers</div>
				<ul id="teachers">
					<li class="b1"><a class="icon new_teach current" href="new_teacher.php">New Teacher</a></li>
					<li class="b2"><a class="icon m_teach" href="manage_teachers.php">Manage Teachers</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Staffs</div>
				<ul id="home">
					<li class="b1"><a class="icon m_staff" href="">Manage Staff</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Students</div>
				<ul id="home">
					<li class="b1"><a class="icon new_stud" href="">New Students</a></li>
					<li class="b2"><a class="icon m_stud" href="">Manage Students</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Graduates</div>
				<ul id="home">
					<li class="b1"><a class="icon view_grad" href="">View All</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Year & Section</div>
				<ul id="home">
					<li class="b1"><a class="icon add_yr_sec" href="">Add Year & Section</a></li>
					<li class="b2"><a class="icon m_yr_sec" href="">Manage Yr. & Sec.</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Announcements</div>
				<ul id="home">
					<li class="b1"><a class="icon new_annmnt" href="">New announcement</a></li>
					<li class="b2"><a class="icon m_annmnt" href="">Manage annncemnts.</a></li>
				</ul>
			</div>
			
			<div class="box">
				<div class="h_title">&#8250; Other</div>
				<ul>
					<li class="b1"><a class="icon events" href="">Events</a></li>
					<li class="b2"><a class="icon mission_vs" href="">Mission & Vision</a></li>
					<li class="b1"><a class="icon gallery" href="">Gallery</a></li>
					<li class="b2"><a class="icon admin_prof" href="">Admin Profile</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Users</div>
				<ul>
					<li class="b1"><a class="icon users" href="">Show all users</a></li>
					<li class="b2"><a class="icon add_user" href="">Add new user</a></li>
					<li class="b1"><a class="icon block_users" href="">Lock users</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Settings</div>
				<ul>
					<li class="b1"><a class="icon config" href="">Site configuration</a></li>
					<li class="b2"><a class="icon contact" href="">Contact Form</a></li>
				</ul>
			</div>
		</div>
		<div id="main">
			<div class="clear"></div>
			<div class="full_w">
				<div id="teacher_wrapper">
					<div class="h_title" id="teach_tab">
						<span id="new_sch_head" class='new_teach_tab current_tab_new_teach'>School Head</span>
						<span id="new_adviser" class='new_teach_tab'>Adviser</span>
						<span id="new_sub_teach" class='new_teach_tab'>Subject Teacher</span>
					</div><!-- end teach_tab -->

					<div id="new_sch_head_wrap">
						<div id="new_sch_head_content">
							<div id="div_alert_new_sch_head"><p class="a_sch_msg"></p></div>
							<h4 class='title_new_entry'>NEW SCHOOL HEAD TEACHER ENTRY</h4>
							<h6 class='b_info'>Basic Information (all <sup>*</sup> are required)</h6>
							<div class="form_layout_medium">
								<form id="new_sch_head_form">
									<label>ID. Number <sup>*</sup></label>
									<input type="text" id="new_sch_head_id_num" name='idNum' class='vali_id_num_sh id_num'/>
									<br/>
									<label>First Name <sup>*</sup></label>
									<input type="text" id="new_sch_head_fname" name='fName' class='vali_fname_sh'/>
									<br/>
									<label>Middle Name <sup>*</sup></label>
									<input type="text" id="new_sch_head_mname" name='mName' class='vali_mname_sh'/>
									<br/>
									<label>Last Name <sup>*</sup></label>
									<input type="text" id="new_sch_head_lname" name='lName' class='vali_lname_sh'/>
									<br/>
									<label>Address <sup>*</sup></label>
									<input type="text" id="new_sch_head_address" name='address' class='vali_address'/>
									<br/>
									<label>Email <sup>*</sup></label>
									<input type="email" id="new_sch_head_email" name='email' class='vali_emailSchH'/>
									<br/>
									<label>Mobile # <sup>*</sup></label>
									<input type="text" id="new_sch_head_mobile" class='vali_mobile' name='mobile' title="format : 09+11 digits"/>
									<br/>
									<label>Age <sup>*</sup></label>
									<input type="text" id="new_sch_head_age" name='age' class='vali_age'/>
									<br/>
									<label>Gender <sup>*</sup></label>
										<select id="new_sch_head_gender" name='gender'>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="Gay">Gay</option>
											<option value="Lesbian">Lesbian</option>
										</select>
									<br/><br/>
									<label>Date of Birth <sup>*</sup></label>
									<input type="text" id="new_sch_head_bdate" class='b_date_datepicker' readonly="readonly" name='bDate'/>
									<br/>
									<label>Rank <sup>*</sup></label>
									<select id="new_sch_head_rank" name='rank'>
										<option value="Head Teacher I">Head Teacher I</option>
										<option value="Head Teacher II">Head Teacher II</option>
										<option value="Head Teacher III">Head Teacher III</option>
										<option value="Principal I">Principal I</option>
										<option value="Principal II">Principal II</option>
										<option value="Principal II">Principal III</option>
									</select>
									<br/><br/>
								</form>
								<div class='div_button_new_sch_head'>
										<button id="btn_save_new_sch_head">Save</button>
										<button id="btn_cancel_new_sch_head" >Cancel</button>
								</div><!-- end div_button_new_sch_head -->
							</div>
						</div> <!-- end new_sch_head_content-->
					</div> <!-- end new_sch_head_wrap -->

					<div id="new_adviser_wrap">
						<div id="new_adviser_content">
							<div id="div_alert_new_adv"><p class="a_adv_msg"></p></div>
							<h4 class='title_new_entry'>NEW ADVISER ENTRY</h4>
							<h6 class='b_info'>Basic Information (all <sup>*</sup> are required)</h6>
							<div id="basic_info_adv" class="form_layout_medium">
							<form id='new_adv_form'>
								<label>ID. Number <sup>*</sup></label>
								<input type="text" id="new_adv_id_num" name='idNum' class='vali_id_num_adv id_num'/>
								<br/>
								<label>First Name <sup>*</sup></label>
								<input type="text" id="new_adv_fname" name='fName' class='vali_fname_adv'/>
								<br/>
								<label>Middle Name <sup>*</sup></label>
								<input type="text" id="new_adv_mname" name='mName' class='vali_mname_adv'/>
								<br/>
								<label>Last Name <sup>*</sup></label>
								<input type="text" id="new_adv_lname" name='lName' class='vali_lname_adv'/>
								<br/>
								<label>Address <sup>*</sup></label>
								<input type="text" id="new_adv_address" name='address'/>
								<br/>
								<label>Email <sup>*</sup></label>
								<input type="email" id="new_adv_email" name='email' class='vali_emailAdv'/>
								<br/>
								<label>Mobile # <sup>*</sup></label>
								<input type="text" id="new_adv_mobile" class='vali_mobile' name='mobile' title="format : 09+11 digits"/>
								<br/>
								<label>Age <sup>*</sup></label>
								<input type="text" id="new_adv_age" name='age' class='vali_age'/>
								<br/>
								<label>Gender <sup>*</sup></label>
									<select id="new_adv_gender" name='gender'>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Gay">Gay</option>
										<option value="Lesbian">Lesbian</option>
									</select>
								<br/><br/>
								<label>Date of Birth <sup>*</sup></label>
								<input type="text" id="new_adv_bdate" class='b_date_datepicker' readonly="readonly" name='bDate'/>
								<br/>
								<label>Rank <sup>*</sup></label>
								<select id="new_adv_rank" name='rank'>
									<option value="Teacher I">Teacher I</option>
									<option value="Teacher II">Teacher II</option>
									<option value="Teacher III">Teacher III</option>
								</select>
								<br/><br/>
							</form><!-- end new_adv_form -->
								
							</div><!-- end basic_info_adv -->
							<div id = "div_advisory">
								<h4 class='s_advisory'>&nbsp;&nbsp;&nbsp; Select one for the advisory class.</h4>
								<table id="tbl_year_sec_to_ass">
									<thead>
										<tr>
											<th></th>
											<th>Year Level</th>
											<th>Section Name</th>
											<th>Y.S. Code</th>
										</tr>
									</thead>
									<tbody id="tbdy_year_sec_to_ass"></tbody>
								</table>
								<form id='new_adv_ext_info'>
								    <label>Adviser for</label>
									<input type='text' class="adviser_for" readonly="readonly" name='ySecCode' style="text-align: center;" />
									<input type='hidden' id='year_sec_id' name='ySecId'/>
									<input type='hidden' id='year_sec_ylevel' name='ySecYLevel'/>
									<input type='hidden' id='year_sec_sname' name='ySecSName'/>
								</form>
								<!-- new_adv_ext_info -->
							</div><!-- end div_advisory -->
							<div class='div_button_new_adv'>
								<button id="btn_proceed_new_adv">Proceed?</button>
								<button id="btn_save_new_adv">Save</button>
								<button id="btn_cancel_new_adv" >Cancel</button>
							</div>
							<br/>
						</div> <!-- end basic_info_adv-->
					</div><!-- end new_adviser_wrap -->

					<div id="new_sub_teach_wrap">
						<div id="new_sub_teach_content">
							<div id="div_alert_new_st" ><p class="a_st_msg"></p></div>
							<h4 class='title_new_entry'>NEW SUBJECT TEACHER ENTRY</h4>
							<h6 class='b_info'>Basic Information (all <sup>*</sup> are required)</h6>
							<div id="basic_info_st" class="form_layout_medium">
							<form id='new_st_form'>
								<label>ID. Number <sup>*</sup></label>
								<input type="text" id="new_st_id_num" name='idNum' class='vali_id_num_st id_num'/>
								<br/>
								<label>First Name <sup>*</sup></label>
								<input type="text" id="new_st_fname" name='fName' class='vali_fname_st'/>
								<br/>
								<label>Middle Name <sup>*</sup></label>
								<input type="text" id="new_st_mname" name='mName' class='vali_mname_st'/>
								<br/>
								<label>Last Name <sup>*</sup></label>
								<input type="text" id="new_st_lname" name='lName' class='vali_lname_st'/>
								<br/>
								<label>Address <sup>*</sup></label>
								<input type="text" id="new_st_address" name='address'/>
								<br/>
								<label>Email <sup>*</sup></label>
								<input type="email" id="new_st_email" name='email' class='vali_email_st'/>
								<br/>
								<label>Mobile # <sup>*</sup></label>
								<input type="text" id="new_st_mobile" class='vali_mobile_st' name='mobile' title="format : 09+11 digits"/>
								<br/>
								<label>Age <sup>*</sup></label>
								<input type="text" id="new_st_age" name='age' class='vali_age'/>
								<br/>
								<label>Gender <sup>*</sup></label>
									<select id="new_st_gender" name='gender'>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Gay">Gay</option>
										<option value="Lesbian">Lesbian</option>
									</select>
								<br/><br/>
								<label>Date of Birth <sup>*</sup></label>
								<input type="text" id="new_st_bdate" class='b_date_datepicker' readonly="readonly" name='bDate'/>
								<br/>
								<label>Rank <sup>*</sup></label>
								<select id="new_st_rank" name='rank'>
									<option value="Teacher I">Teacher I</option>
									<option value="Teacher II">Teacher II</option>
									<option value="Teacher III">Teacher III</option>
								</select>
								<input type='hidden' name='teacherType' value="Subject Teacher"/>
								<input type='hidden' name='profilePic' value="profile_pic_teachers/avatar.gif"/>
								<br/><br/>
							</form><!-- end new_st_form -->
							</div><!-- end basic_info_st -->
							<div class='div_button_new_adv'>
								<button id="btn_save_new_st">Save</button>
								<button id="btn_cancel_new_st" >Cancel</button>
							</div>
							<br/>
						</div> <!-- end new_sub_teach_content -->
					</div> <!-- end new_sub_teach_wrap -->

				</div> <!-- end teacher_wrapper -->
			</div> <!-- end full_w -->

		</div> <!-- end main -->
		<div class="clear"></div>
	</div> <!-- content -->

	<div id="footer">
		<div class="left">
			<p>Design: <a href="http://www.facebook.com/ramel.coletana" target="_blank">Ramel Relampagos Coletana</a> | Admin Panel: <a href="">YourSite.com</a></p>
		</div>
		<div class="right">
			<p><a href="http://www.petefreitag.com/cheatsheets/jqueryui-icons/" target="_blank">JQuery icons-set</a> | <a href="http://www.github.com" target="_blank">github.com</a></p>
		</div>
	</div> <!-- end footer -->
	
	<div class='dialog_save_new_sch_head' title='Saving new school head teacher'>
		<p>
		<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
		These data will save permanently to database. Are you sure?<br/>
		You can change the data by clicking no or the close icon.</p>
	</div>
	<!-- END dialog_save_new_sch_head -->
	<div class='dialog_save_new_adv' title='Saving new adviser teacher'>
		<p>
		<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
		These data will save permanently to database. Are you sure?<br/>
		You can change the data by clicking no or the close icon.</p>
	</div>
	<!-- END dialog_save_new_adv -->
	<div class='dialog_save_new_st' title='Saving new subject teacher'>
		<p>
		<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
		These data will save permanently to database. Are you sure?<br/>
		You can change the data by clicking no or the close icon.</p>
	</div>
	<!-- END dialog_save_new_st -->
</div>

</body>
</html>
