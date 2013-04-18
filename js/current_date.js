$(document).ready(function(){
	//
	setInterval(function(){
		setDateTime2();
	},1000);

});
//SET CURRENT DATE AND TIME
function setDateTime2(){
	var objToday = new Date(),
        weekday = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),
        dayOfWeek = weekday[objToday.getDay()],
        domEnder = new Array( 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th' ),
        dayOfMonth = today + (objToday.getDate() < 10) ? '0' + objToday.getDate() + domEnder[objToday.getDate()] : objToday.getDate() + domEnder[parseFloat(("" + objToday.getDate()).substr(("" + objToday.getDate()).length - 1))],
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
        curMonth = months[objToday.getMonth()],
        curYear = objToday.getFullYear(),
        curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),
        curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes(),
        curSeconds = objToday.getSeconds() < 10 ? "0" + objToday.getSeconds() : objToday.getSeconds(),
        curMeridiem = objToday.getHours() > 12 ? "PM" : "AM";
        
        var month = objToday.getMonth() + 1;
        var day = objToday.getDate();
   		if(month<10){
   			month = "0"+month;
   		}
        if(day<10){
        	day = "0"+day;
        }
        if(curHour<10){
        	curHour = "0"+curHour;
        }
        
	var today = curYear + "-" + month + "-" + day +" "+ curHour + ":" + curMinute + ":" + curSeconds + " ";
	$('.c_date_time').html(today);
	$('.cur_meridiem').html(curMeridiem);
}