$(function(){
	clearInput();//reset data
	disabledSNA();//disabled btn_save_new_adv
	//date picker
	$('.b_date_datepicker').datepicker({
		dateFormat : "yy-mm-dd",
		changeYear : true
	});
	//open the new_sch_head_wrap
	$('#new_sch_head_wrap').show();
	
	/*KEYUP VALIDATION*/
	//validate id number
	$('.vali_id_num_sh').keyup(function(){
		valIdNumSH();
	});
	//
	$('.vali_id_num_adv').keyup(function(){
		valIdNumAdv();
	});
	//validate name
	$('.vali_fname_sh').keyup(function(){
		valFNameSH();
	});
	$('.vali_mname_sh').keyup(function(){
		valMNameSH();
	});
	$('.vali_lname_sh').keyup(function(){
		valLNameSH();
	});
	//
	$('.vali_fname_adv').keyup(function(){
		valFNameAdv();
	});
	$('.vali_mname_adv').keyup(function(){
		valMNameAdv();
	});
	$('.vali_lname_adv').keyup(function(){
		valLNameAdv();
	});
	//validate mobile number
	$('#new_sch_head_mobile').keyup(function(){//new school head mobile number
		valMobileNumSH();
	});
	$('#new_adv_mobile').keyup(function(){//new adviser mobile number
		valMobileNumAdv();
	});
	//validate age
	$('#new_sch_head_age').keyup(function(){//new school head age
		valAgeSH();
	});
	$('#new_adv_age').keyup(function(){//new adviser age
		valAgeAdv();
	});
	
	$('#new_sch_head').click(function(){
		clearInput();//reset data
		removeClassNewTeachTab();
		$('#new_sch_head').addClass("current_tab_new_teach");
		hideTabContentNewTeach();
		$('#new_sch_head_wrap').show("blind",1000);
	});//add class current_tab_new_teach
	
	//Save new school head
	$('#btn_save_new_sch_head').click(function(){
		saveNewHeadTeacher();
	});
	//clear form for new school head
	$('#btn_cancel_new_sch_head').click(function(){
		clearInput();
	});


	//
	$('#new_adviser').click(function(){
	clearInput();//reset data
		removeClassNewTeachTab();
		$('#new_adviser').addClass("current_tab_new_teach");
		hideTabContentNewTeach();
		$('#new_adviser_wrap').show("blind",1000);
	});//add class current_tab_new_teach
	$('#btn_proceed_new_adv').click(function(){
		enabledSNA();//enabled btn_save_new_adv
		getYSAdv();//get year and section for advisory
	});
	//
	$('#tbdy_year_sec_to_ass').on("click","tr",function(){
		var tr_id = this.id;
		var cell = document.getElementById(tr_id).getElementsByTagName('td');
		var ysId = tr_id.substring(5);
		var ysYLevel = cell[1].innerHTML;
		var ysSName = cell[2].innerHTML;
		var ysCode = cell[3].innerHTML;
		$('#year_sec_id').val(ysId);
		$('#year_sec_ylevel').val(ysYLevel);
		$('#year_sec_sname').val(ysSName);
		$('.adviser_for').val(ysCode);
		$('#radio_year_sec_adv'+ysId).attr('checked',true); //it can also be attr('checked','checked');
	});
	//saving new adviser
	$('#btn_save_new_adv').click(function(){
		disabledPNA();//disabled btn_proceed_new_adv
		saveNewAdv();//save new adviser
	});
	//reset input
	$('#btn_cancel_new_adv').click(function(){
		enabledPNA();//enabled btn_proceed_new_adv
		clearInput();//clear all field
		hideDivAdvisory();//hiding div_advisory
		disabledSNA();//disabled btn_save_new_adv
	});


	//
	$('#new_sub_teach').click(function(){
		clearInput();//reset data
		removeClassNewTeachTab();
		$('#new_sub_teach').addClass("current_tab_new_teach");
		hideTabContentNewTeach();
		$('#new_sub_teach_wrap').show("blind",1000);
	});//add class current_tab_new_teach

	
});

/*F U N C T I O N S*/

//REMOVE CLASS FOR THE NEW TEACHER TAB
function removeClassNewTeachTab(){
	$('#new_sch_head').removeClass("current_tab_new_teach");
	$('#new_adviser').removeClass("current_tab_new_teach");
	$('#new_sub_teach').removeClass("current_tab_new_teach");
}

//HIDING TAB CONTENT
function hideTabContentNewTeach(){
	$('#new_sch_head_wrap').hide();
	$('#new_adviser_wrap').hide();
	$('#new_sub_teach_wrap').hide();
}

//VALIDATE ID NUM
function valIdNumSH(){//new school head
	var regexS = /^[a-zA-Z0-9\-]$/;
	var id = $('#new_sch_head_id_num').val();
	var idLength = id.length;
	var idLastIn = id.substring(idLength-1,idLength);
	if(!regexS.test(idLastIn)){
		var res = id.substring(0,idLength-1);
		$('#new_sch_head_id_num').val(res);
	}
	
}
function valIdNumAdv(){//new adv
	var id = $('#new_adv_id_num').val();
	var regexS = /^[a-zA-Z0-9\-]$/;
	var idLength = id.length;
	var idLastIn = id.substring(idLength-1,idLength);
	if(!regexS.test(idLastIn)){
		var res = id.substring(0,idLength-1);
		$('#new_adv_id_num').val(res);
	}
}
//VALIDATE NAME
//new school head
function valFNameSH(){
	var regexF = /^[A-Za-z\s]$/;
	var fname = $('.vali_fname_sh').val();
	var fLength = fname.length;
	var fLastIn = fname.substring(fLength-1, fLength);
	if(!regexF.test(fLastIn)){
		var res = fname.substring(0, fLength-1);
		$('.vali_fname_sh').val(res);
	}
}
function valMNameSH(){
	var regexM = /^[A-Za-z\s]$/;
	var mname = $('.vali_mname_sh').val();
	var mLength = mname.length;
	var mLastIn = mname.substring(mLength-1, mLength);
	if(!regexM.test(mLastIn)){
		var res = mname.substring(0, mLength-1);
		$('.vali_mname_sh').val(res);
	}
}
function valLNameSH(){
	var regexL = /^[A-Za-z\s]$/;
	var lname = $('.vali_lname_sh').val();
	var lLength = lname.length;
	var lLastIn = lname.substring(lLength-1, lLength);
	if(!regexL.test(lLastIn)){
		var res = lname.substring(0, lLength-1);
		$('.vali_lname_sh').val(res);
	}
}
//new adviser
function valFNameAdv(){
	var regexF = /^[A-Za-z\s]$/;
	var fname = $('.vali_fname_adv').val();
	var fLength = fname.length;
	var fLastIn = fname.substring(fLength-1, fLength);
	if(!regexF.test(fLastIn)){
		var res = fname.substring(0, fLength-1);
		$('.vali_fname_adv').val(res);
	}
}
function valMNameAdv(){
	var regexM = /^[A-Za-z\s]$/;
	var mname = $('.vali_mname_adv').val();
	var mLength = mname.length;
	var mLastIn = mname.substring(mLength-1, mLength);
	if(!regexM.test(mLastIn)){
		var res = mname.substring(0, mLength-1);
		$('.vali_mname_adv').val(res);
	}
}
function valLNameAdv(){
	var regexL = /^[A-Za-z\s]$/;
	var lname = $('.vali_lname_adv').val();
	var lLength = lname.length;
	var lLastIn = lname.substring(lLength-1, lLength);
	if(!regexL.test(lLastIn)){
		var res = lname.substring(0, lLength-1);
		$('.vali_lname_adv').val(res);
	}
}
//VALIDATE EMAIL ADDRESS
function valEmailSchH(){//for the new_sch_head_form
	var regexEm = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var email = $('.vali_emailSchH').val();
	if(regexEm.test(email)){
		return true;
	}else{
		return false;
	}
}
function valEmailAdv(){//for the new_adv_form
	var regexEm = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var email = $('.vali_emailAdv').val();
	if(regexEm.test(email)){
		return true;
	}else{
		return false;
		$('.vali_emailAdv').focus();
	}
}

//VALIDATE MOBILE NUMBER
function valMobileNumSH(){//new school head mobile
	var regexM = /^[0-9]$/;
	var mobile = $('#new_sch_head_mobile').val();

	var mobileLength = mobile.length;
	var mLastInput = mobile.substring(mobileLength-1,mobileLength);
	if(!regexM.test(mLastInput)){
		var res = mobile.substring(0,mobileLength-1);
		$('#new_sch_head_mobile').val(res);
	}
	if(mobileLength > 11){
		var res = mobile.substring(0,mobileLength-1);
		$('#new_sch_head_mobile').val(res);
	}
}
function valMobileNumAdv(){//new adviser mobile
	var regexM = /^[0-9]$/;
	var mobile = $('#new_adv_mobile').val();

	var mobileLength = mobile.length;
	var mLastInput = mobile.substring(mobileLength-1,mobileLength);
	if(!regexM.test(mLastInput)){
		var res = mobile.substring(0,mobileLength-1);
		$('#new_adv_mobile').val(res);
	}
	if(mobileLength > 11){
		var res = mobile.substring(0,mobileLength-1);
		$('#new_adv_mobile').val(res);
	}
}
//VALIDATE AGE
function valAgeSH(){//new school head age
	var regexA = /^[0-9]$/;
	var age = $('#new_sch_head_age').val();
	var ageLength = age.length;
	var aLastInput = age.substring(ageLength-1,ageLength);
	if(!regexA.test(aLastInput)){
		var res = age.substring(0,ageLength-1);
		$('#new_sch_head_age').val(res);
	}
	if(ageLength > 3){
		var res = age.substring(0,ageLength-1);
		$('#new_sch_head_age').val(res);
	}
}
function valAgeAdv(){//new school head age
	var regexA = /^[0-9]$/;
	var age = $('#new_adv_age').val();
	var ageLength = age.length;
	var aLastInput = age.substring(ageLength-1,ageLength);
	if(!regexA.test(aLastInput)){
		var res = age.substring(0,ageLength-1);
		$('#new_adv_age').val(res);
	}
	if(ageLength > 3){
		var res = age.substring(0,ageLength-1);
		$('#new_adv_age').val(res);
	}
}

/*-----------------NEW SCHOOL HEAD------------------*/
//SAVE NEW HEAD TEACHER
function saveNewHeadTeacher(){
	var obj = {'data': JSON.stringify($('#new_sch_head_form').serializeArray())};
	
	var idNum = $('#new_sch_head_id_num').val();
	var fName = $('#new_sch_head_fname').val();
	var mName = $('#new_sch_head_mname').val();
	var lName = $('#new_sch_head_lname').val();
	var address = $('#new_sch_head_address').val();
	var email = $('#new_sch_head_email').val();
	var mobile = $('#new_sch_head_mobile').val();
	var age = $('#new_sch_head_age').val();
	var gender = $('#new_sch_head_gender').val();
	var bDate = $('#new_sch_head_bdate').val();
	var rank = $('#new_sch_head_rank').val();
	var profilePic = "profile_pic_teachers/avatar.gif";
	var fullName = fName+" "+mName+" "+lName;
	var checkEm = valEmailSchH();

	//validate email address
	//var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	if(idNum === "" || fName === "" || mName === "" || address === "" || email === "" || mobile === "" || age === ""
		|| gender === "" || bDate === ""){

		$('#div_alert_new_sch_head').addClass("n_error");
		$('.a_sch_msg').html("All field are required to fill up!");
	}else if(!checkEm){
		$('#new_sch_head_email').focus();
		$('#div_alert_new_sch_head').addClass("n_error");
		$('.a_sch_msg').html("Invalid email address!");
	}else{
		$('#div_alert_new_sch_head').removeClass("n_error");
		$('#div_alert_new_sch_head').addClass("n_ok");
		$('.a_sch_msg').html("Successfully saved.");
		
			$.ajax({
			 	type: 'POST',
			 	url: 'process/save_new_sch_head.php',
			 	data: obj,
			 	success: function(data){
			 		console.log(data);
					clearInput();
			 	},
			 	error: function(data){
			 		alert("error in saving new school head teacher =>"+data);
			 	}
			});
	}
}
//CLEAR NEW SCHOOL HEAD FORM
//CLEAR input 
function clearInput(){
	$('#year_sec_id').val("");
	$('#year_sec_ylevel').val("");
	$('#year_sec_sname').val("");
	$('#adviser_for').val("");
	$("input[type='text']").val("");
	$("input[type='email']").val("");
}
/*-----------------NEW ADVISER------------------*/
//disabled/enabled button btn_proceed_new_adv, btn_save_new_adv, btn_cancel_new_adv
function disabledPNA(){//PNA->btn_proceed_new_adv
	$('#btn_proceed_new_adv').attr('disabled','disabled');
}
function enabledPNA(){//PNA->btn_proceed_new_adv
	$('#btn_proceed_new_adv').removeAttr('disabled');
}
function disabledSNA(){//SNA->btn_save_new_adv
	$('#btn_save_new_adv').attr('disabled','disabled');
}
function enabledSNA(){//SNA->btn_save_new_adv
	$('#btn_save_new_adv').removeAttr('disabled');
}
function disabledCNA(){//CNA->btn_cancel_new_adv
	$('#btn_cancel_new_adv').attr('disabled','disabled');
}
function enabledCNA(){//CNA->btn_cancel_new_adv
	$('#btn_cancel_new_adv').removeAttr('disabled');
}
//show/hide div_advisory
function showDivAdvisory(){
	$('#div_advisory').show('blind',1000);
}
function hideDivAdvisory(){
	$('#div_advisory').hide('blind',1000);
}
//GET ADVISORY NO ASSIGNED
function getYSAdv(){
	//showing div_advisory
	showDivAdvisory();
	clearInput();

	var obj = {"status": 1};
	$.ajax({
		type: 'GET',
		url: 'process/getYSAdv.php',
		data: obj,
		success: function(data){
			if(data==="noData"){
				data = "<tr><td colspan=4 class=noDataFound style='text-align: center; color: red;'>No data found..</td></tr>";
			}
			$('#tbdy_year_sec_to_ass').html(data);
		},
		error: function(data){
			alert("error!..getYSAdv.line.=>"+data);
		}
	});
}

//SAVE NEW ADVISER
function saveNewAdv(){
	var obj = {'data': JSON.stringify($('#new_adv_form').serializeArray())};
	var data = $('#new_adv_form').serializeArray();
	var blank = false;
	
	for(var ctr = 0;ctr<data.length;ctr++){
		if(data[ctr].value==="" || data[ctr].value==="  " || data[ctr].value===null){	
			blank = true;
			break;
		}
	}
	alert(blank);
	//if(!reg.test(data[0].value) || data[0].value===""){
		//alert('hello');
	//}
	//alert(data[0].value);
	var checkEm = valEmailAdv();
	if(!checkEm){
		$('#new_adv_email').focus();
	}
	
	$.ajax({
		type: 'POST',
		url: 'process/save_new_adv.php',
		data: obj,
		success: function(data){
			//alert(data);
		},
		error: function(data){
			alert('error in saving new adviser = > '+data);
		}
	});
}