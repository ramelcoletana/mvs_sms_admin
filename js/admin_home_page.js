$(document).ready(function(){
	
	//VIEW LATES ANNOUNCEMENTS
	viewLatestAnn();
	//VIEW UPCOMING EVENTS
	viewLatestEvent();

	//LOGOUT ADMIN
	$('#a_logout').click(function(){
		var dateLL = $('.c_date_time').html();
		var obj = {"dateLL": dateLL};
		$.ajax({
			type: 'POST',
			url: 'process/setLastLogin.php',
			data: obj,
			success: function(data){
				console.log(data);
			},
			error: function(data){
				alert("error in setting the last login=>"+data);
			}
		});
	});

	//VIEW ALL ANNOUNCEMENTS
	$('.div_all_announcements').hide();
	viewAllAnnouncements();
	$("#view_all_ann").click( function() {
	 	$('.div_all_announcements').slideToggle(1000);
	 	$('#ann_toggle_sign').toggleClass("round_minus");
	});
	
	//VIEW ALL EVENTS
	$('.div_all_events').hide();
	viewAllEvents();
	$('#view_all_events').click(function(){
		$('.div_all_events').slideToggle(1000);
		$('#event_toggle_sign').toggleClass("round_minus");
	});

});

/*------------------------------------F U N C T I O N S-----------------------------------------*/
//view latest announcements
function viewLatestAnn(){
	var obj = {"status": "active"};
	$.ajax({
		type: 'POST',
		data: obj,
		url: 'process/viewLatestAnn.php',
		success: function(data){
			$('.latest_announcemnt').html(data);
		},
		error: function(data){
			alert("error in viewing latest announcements=>"+data);
		}
	});
}

//view latest events
function viewLatestEvent(){
	var status = "active";
	var obj = {"status" :status};
	$.ajax({
		type: 'POST',
		url: 'process/viewLatesEvent.php',
		data: obj,
		success: function(data){
			$('.upcoming_events').html(data);
		},
		error: function(data){
			alert("error in viewing latest events=>"+data);
		}
	});
}

//view all announcements
function viewAllAnnouncements(){
	$.ajax({
		type: 'POST',
		url: 'process/viewAllAnnouncements.php',
		success: function(data){
			$('.div_all_announcements').append(data);
		},
		error: function(data){
			alert("error in view all announcements =>"+data);
		}
	});
}

//view all events
function viewAllEvents(){
	$.ajax({
		type: 'POST',
		url: 'process/viewlAllEvents.php',
		success: function(data){
			$('.div_all_events').append(data);
		},
		error: function(data){
			alert("error in viewing all events =>"+data);
		}
	});
}