<?php
session_start();
include "DAO/func_admin.php";

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['admin_password'])){
		header("location: login.php");
	}else{
		echo "<input type='hidden' class=admin_username value=".$_SESSION['admin_username']." />";
		echo "<input type='hidden' class=admin_password value=".$_SESSION['admin_password']."/>";
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
<meta name="author" content="Ramel Relampagos Coletana" />
<title>MVS &raquo; ADMIN | Home</title>
<link rel="icon" href="img/sms.ico"/>
<!--link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap.css'/-->
<link rel='stylesheet' type='text/css' href='themes/base/jquery.ui.all.css'/>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/index.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/navi.css" media="screen" />

<!--script type="text/javascript" src="js/jquery.1.9.2.min.js"></script-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js-ui/jquery-ui-darkhive.js"></script>

<script type="text/javascript" src="js/admin_home_page.js"></script>
<script type="text/javascript" src="js/current_date.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	//$(".box .h_title").not(this).next("#home").show("normal");
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
					<img src=" <?php if( isset($pic)){ echo $pic; }else{ echo "img/avatar.gif";} ?>"
					style="width: 20px; height: 20px; border: 0 none; margin: 0 auto; border-radius: 2px;"/>
				</div>
				<p style="margin-left: 33px;">Welcome, <strong id='admin_name'>
					<?php
						echo $_SESSION['admin_name'];
					?>
				</strong> [ <a href="logout.php" id="a_logout">logout</a> ]
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
				<li class="upp"><a href="index.php" class="current">Home</a></li>
				<li class="upp"><a href="#">Teachers</a>
					<ul>
						<li>&#8250; <a href="pages/new_teacher.php">New Teacher</a></li>
						<li>&#8250; <a href="pages/manage_teachers.php">Manage Teachers</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Staffs</a>
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
				<div class="h_title">&#8250; <a href="index.php" class="current">Home</a></div>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Teachers</div>
				<ul id="home">
					<li class="b1"><a class="icon new_teach" href="pages/new_teacher.php">New Teacher</a></li>
					<li class="b2"><a class="icon m_teach" href="pages/manage_teachers.php">Manage Teachers</a></li>
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
			<div class="half_w half_left">
				<div class="h_title">Visits statistics</div>
					<script src="js/highcharts_init.js"></script>
					<div id="container" style="min-width: 300px; height: 180px; margin: 0 auto"></div>
					<script src="js/highcharts.js"></script>
				</div>
			<div><!-- end half_w half_left -->

			<div class="half_w half_right">
				<div class="h_title">Site statistics</div>
				<div class="stats">
					<div class="today">
						<h3>Today</h3>
						<p class="count">2 349</p>
						<p class="type">Visits</p>
						<p class="count">96</p>
						<p class="type">Comments</p>
						<p class="count">9</p>
						<p class="type">Articles</p>
					</div>
					<div class="week">
						<h3>Last week</h3>
						<p class="count">12 931</p>
						<p class="type">Visits</p>
						<p class="count">521</p>
						<p class="type">Comments</p>
						<p class="count">38</p>
						<p class="type">Articles</p>
					</div>
				</div>
			</div><!-- end half_w half_right -->
			<div class="clear"></div>

			<div class="announcement_wrapper">
				<div class="h_title">Announcements</div>
				<div class="announcement_content">
					<strong class="t_latest_ann">(Latest announcement)</strong>
					<div class="latest_announcemnt"></div>

					<div class="div_all_ann_wrapper">
						<div id="view_all_ann"><span id="ann_toggle_sign" class="round_plus"></span>&nbsp;&nbsp;&nbsp;<span class="span_all_ann_events">All Announcements</span></div>
						<div class="div_all_announcements"></div><!-- end div_all_announcements -->
					</div><!-- end div_all_ann_wrapper -->

				</div><!-- end announcement_content -->
			</div><!-- end announcement_wrapper -->
			<div class="clear"></div>

			<div class="events_wrapper">
				<div class='h_title'>Events</div>
				<div class="events_contents">
				<strong class="t_upcoming_events">(Upcoming event(s))</strong>
				<div class="upcoming_events"></div>

				</div><!-- end events_contents -->

				<div class="div_all_events_wrapper">
					<div id="view_all_events">
						<span id="event_toggle_sign" class="round_plus"></span>&nbsp;&nbsp;&nbsp;<span class="span_all_ann_events">All events</span>
					</div>
					<div class="div_all_events"></div> <!-- end div_all_events -->
				</div><!-- end div_all_events_wrapper -->

			</div><!-- end events_wrapper -->
			<div class="clear"></div>

		</div><!-- end main -->
		<div class="clear"></div>
	</div><!-- end content -->

	<div id="footer">
		<div class="left">
			<p>Design: <a href="http://www.facebook.com/ramel.coletana" target="_blank">Ramel Relampagos Coletana</a> | Admin Panel: <a href="">YourSite.com</a></p>
		</div>
		<div class="right">
			<p><a href="http://www.petefreitag.com/cheatsheets/jqueryui-icons/" target="_blank">JQuery icons-set</a> | <a href="http://www.github.com" target="_blank">github.com</a></p>
		</div>
	</div> <!-- end footer -->
</div>

</body>
</html>
