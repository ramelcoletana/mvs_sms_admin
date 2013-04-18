<?php
session_start();
include "DAO/func_admin.php";

	if(!isset($_SESSION['admin_username']) && !isset($_SESSION['admin_password'])){
		header("location: login.php");
	}else{
		$name = new func_admin();
		$n = $name->get_admin_name($_SESSION['admin_username'],$_SESSION['admin_password']);
		$_SESSION['admin_name'] = $n;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
<title>template</title>
<link rel="icon" href="img/sms.ico"/>

<link rel='stylesheet' type='text/css' href='themes/base/jquery.ui.all.css'/>
<link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap.css'/>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/navi.css" media="screen" />

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js-ui/jquery-ui-darkhive.js"></script>
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
				<p>Welcome, <strong id='admin_name'>
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
					</strong></p>
				</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<li class="upp"><a href="index.php" class="current">Home</a></li>
				<li class="upp"><a href="#">Teachers</a>
					<ul>
						<li>&#8250; <a href="">New Teacher</a></li>
						<li>&#8250; <a href="">Manage Teachers</a></li>
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
				<div class="h_title">&#8250; <a href="index.php" class="current">Home</a></div>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Teacher</div>
				<ul id="home">
					<li class="b1"><a class="icon new_teach" href="">New Teacher</a></li>
					<li class="b2"><a class="icon m_teach" href="">Manage Teachers</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Staff</div>
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
			<div class="half_w half_left">
				<div class="h_title">Visits statistics</div>
					<script src="js/highcharts_init.js"></script>
					<div id="container" style="min-width: 300px; height: 180px; margin: 0 auto"></div>
					<script src="js/highcharts.js"></script>
			</div>
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
			</div>
			
			<div class="clear"></div>
			
			<div class="full_w">
				<div class="h_title">Paragraph, headers, lists, notify</div>
				<h1>Level 1 header</h1>
				<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takim</p>
				<h2>Level 2 header</h2>
				<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor i</p>
				<h3>Level 3 header</h3>
				<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvolupt</p>
				<h3>Unordered list</h3>
				<ul>
					<li>first list item, Lorem ipsum dolor sit amet, consete</li>
					<li>second list item, Lorem ipsum dolor sit amet, consete</li>
					<li>third list item, Lorem ipsum dolor sit amet, consete</li>
					<li>fourth list item, Lorem ipsum dolor sit amet, consete</li>
				</ul>
				<h3>Ordered list</h3>
				<ol>
					<li>first list item, Lorem ipsum dolor sit amet, consete</li>
					<li>second list item, Lorem ipsum dolor sit amet, consete</li>
					<li>third list item, Lorem ipsum dolor sit amet, consete</li>
					<li>fourth list item, Lorem ipsum dolor sit amet, consete</li>
				</ol>
                <div class="n_warning"><p>Attention notification. Lorem ipsum dolor sit amet, consetetur, sed diam nonumyeirmod tempor.</p></div>
				<div class="n_ok"><p>Success notification. Lorem ipsum dolor sit amet, consetetur, sed diam nonumyeirmod tempor.</p></div>
				<div class="n_error"><p>Error notification. Lorem ipsum dolor sit amet, consetetur, sed diam nonumyeirmod tempor.</p></div>		
			</div>
			
			<div class="full_w">
				<div class="h_title">Add new page - form elements</div>
				<form action="" method="post">
					<div class="element">
						<label for="name">Page title <span class="red">(required)</span></label>
						<input id="name" name="name" class="text err" />
					</div>
					<div class="element">
						<label for="category">Category <span class="red">(required)</span></label>
						<select name="category" class="err">
							<option value="0">-- select category</option>
							<option value="1">Category 1</option>
							<option value="2">Category 4</option>
							<option value="3">Category 3</option>
						</select>
					</div>
					<div class="element">
						<label for="comments">Comments</label>
						<input type="radio" name="comments" value="on" checked="checked" /> Enabled <input type="radio" name="comments" value="off" /> Disabled
					</div>
					<div class="element">
						<label for="attach">Attachments</label>
						<input type="file" name="attach" />
					</div>
					<div class="element">
						<label for="content">Page content <span>(required)</span></label>
						<textarea name="content" class="textarea" rows="10"></textarea>
					</div>
					<div class="entry">
						<button type="submit">Preview</button> <button type="submit" class="add">Save page</button> <button class="cancel">Cancel</button>
					</div>
				</form>
			</div>
			
			<div class="full_w">
				<div class="h_title">Manage pages - table</div>
				<h2>Lorem ipsum dolor sit ame</h2>
				<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvolupt</p>
				
				<div class="entry">
					<div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Title</th>
							<th scope="col">Author</th>
							<th scope="col">Date</th>
							<th scope="col">Category</th>
							<th scope="col" style="width: 65px;">Modify</th>
						</tr>
					</thead>
						
					<tbody>
						<tr>
							<td class="align-center">2</td>
							<td>Home</td>
							<td>Paweł B.</td>
							<td>22-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>
						<tr>
							<td class="align-center">3</td>
							<td>Our offer</td>
							<td>Paweł B.</td>
							<td>22-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>
							
						<tr>
							<td class="align-center">5</td>
							<td>About</td>
							<td>Admin</td>
							<td>23-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>
							
						<tr>
							<td class="align-center">12</td>
							<td>Contact</td>
							<td>Admin</td>
							<td>25-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>						
						<tr>
							<td class="align-center">114</td>
							<td>Portfolio</td>
							<td>Paweł B.</td>
							<td>22-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>
							
						<tr>
							<td class="align-center">116</td>
							<td>Clients</td>
							<td>Admin</td>
							<td>23-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>
							
						<tr>
							<td class="align-center">131</td>
							<td>Customer reviews</td>
							<td>Admin</td>
							<td>25-03-2012</td>
							<td>-</td>
							<td>
								<a href="#" class="table-icon edit" title="Edit"></a>
								<a href="#" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="entry">
					<div class="pagination">
						<span>« First</span>
						<span class="active">1</span>
						<a href="">2</a>
						<a href="">3</a>
						<a href="">4</a>
						<span>...</span>
						<a href="">23</a>
						<a href="">24</a>
						<a href="">Last »</a>
					</div>
					<div class="sep"></div>		
					<a class="button add" href="">Add new page</a> <a class="button" href="">Categories</a> 
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div id="footer">
		<div class="left">
			<p>Design: <a href="http://www.facebook.com/ramel.coletana" target="_blank">Ramel Relampagos Coletana</a> | Admin Panel: <a href="">YourSite.com</a></p>
		</div>
		<div class="right">
			<p><a href="http://www.petefreitag.com/cheatsheets/jqueryui-icons/" target="_blank">JQuery icons-set</a>| <a href="http://www.github.com" target="_blank">github.com</a></p>
		</div>
	</div> <!-- end footer -->
</div>

</body>
</html>
