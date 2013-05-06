$(function(){
    genIdNum();
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
		genIdNum();
		removeClassNewTeachTab();
		removeClassAlert();
		$('#new_sch_head').addClass("current_tab_new_teach");
		hideTabContentNewTeach();
		$('#new_sch_head_wrap').show();
	});//add class current_tab_new_teach
	
	//Save new school head
	//var w = window.innerWidth;
	$('#btn_save_new_sch_head').click(function(){
		$('.dialog_save_new_sch_head').dialog({
				modal: true,
				resizable: false,
				buttons: {
						Yes: function(){
								saveNewHeadTeacher();
								$(this).dialog("close");
						},
						No: function(){
								$(this).dialog("close");
						}
				}
		});
	});
	//clear form for new school head
	$('#btn_cancel_new_sch_head').click(function(){
		clearInput();
		genIdNum();
	});


	//
	$('#new_adviser').click(function(){
		clearInput();//reset data
		genIdNum();
		removeClassNewTeachTab();
		removeClassAlert();
		$('#new_adviser').addClass("current_tab_new_teach");
		hideTabContentNewTeach();
		$('#new_adviser_wrap').show();
	});//add class current_tab_new_teach
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
	$('#btn_proceed_new_adv').click(function(){
		disabledPNA();
		enabledSNA();//enabled btn_save_new_adv
		getYSAdv();//get year and section for advisory
	});
	//
	
	$('#btn_save_new_adv').click(function(){
		  $('.dialog_save_new_adv').dialog({
				modal: true,
				resizable: false,
				buttons: {
						Yes: function(){
								disabledPNA();//disabled btn_proceed_new_adv
								saveNewAdv();//save new adviser
								$(this).dialog("close");
						},
						No: function(){
								$(this).dialog("close");
						}
				}
		});
		
	});
	//reset input
	$('#btn_cancel_new_adv').click(function(){
		enabledPNA();//enabled btn_proceed_new_adv
		clearInput();//clear all field
		genIdNum();
		hideDivAdvisory();//hiding div_advisory
		disabledSNA();//disabled btn_save_new_adv
	});


	//NEW SUBJECT TEACHER
	$('#new_sub_teach').click(function(){
		clearInput();//reset data
		genIdNum();
		removeClassNewTeachTab();
		removeClassAlert();
		$('#new_sub_teach').addClass("current_tab_new_teach");
		hideTabContentNewTeach();
		$('#new_sub_teach_wrap').show();
	});//add class current_tab_new_teach
	//id num blur()
	$('#new_st_id_num').blur(function(){
		idNumExist();	
	});
	$('#new_st_id_num').keyup(function(){
	   valiIdNumST();
	});
	$('#new_st_fname').keyup(function(){
		valiFNameST();
	});
	$('#new_st_mname').keyup(function(){
		valiMNameST();
	});
	$('#new_st_lname').keyup(function(){
		valiLNameST();
	});
	$('#new_st_email').blur(function(){
		valiEmailST();
	});
	$('#new_st_mobile').keyup(function(){
		valiMobileST();
	});
	$('#new_st_age').keyup(function(){
		valiAgeST();
	});
	
	//save new subject teacher
	$('#btn_save_new_st').click(function(){
		$('.dialog_save_new_st').dialog({
			modal: true,
			resizable: false,
			buttons: {
				Yes: function(){
					saveNewST();
					$(this).dialog("close");
				},
				No: function(){
					$(this).dialog("close");
				}
			}
		});
	});
	
});

/*F U N C T I O N S*/
//GENERATE AUTO ID NUMBER
function genIdNum() {
	$.ajax({
		type: 'POST',
		url: 'process/genIdNum.php',
		success: function(data){
				var fm = "TID-MVSPB-";
				$('.id_num').val(fm+data);
		},
		error: function(data){
				console.log("error in generating ir number --..-- "+data);
		}
	});
}

//REMOVE CLASS FOR THE NEW TEACHER TAB
function removeClassNewTeachTab(){
	$('#new_sch_head').removeClass("current_tab_new_teach");
	$('#new_adviser').removeClass("current_tab_new_teach");
	$('#new_sub_teach').removeClass("current_tab_new_teach");
}

//CLEAR input 
function clearInput(){
	$('#year_sec_id').val("");
	$('#year_sec_ylevel').val("");
	$('#year_sec_sname').val("");
	$('#adviser_for').val("");
	$("input[type='text']").val("");
	$("input[type='email']").val("");
	exist = false;
	notValid = false;
}
function removeClassAlert() {
		$('#div_alert_new_sch_head').removeClass('n_error');
		$('#div_alert_new_sch_head').removeClass('n_warning');
		$('#div_alert_new_sch_head').removeClass('n_ok');
		
		$('#div_alert_new_adv').removeClass('n_error');
		$('#div_alert_new_adv').removeClass('n_warning');
		$('#div_alert_new_adv').removeClass('n_ok');
		
		$('#div_alert_new_st').removeClass('n_error');
		$('#div_alert_new_st').removeClass('n_warning');
		$('#div_alert_new_st').removeClass('n_ok');
		
		$('.a_sch_msg').html("");
		$('.a_adv_msg').html("");
		$('.a_st_msg').html("");
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
					genIdNum();
			 	},
			 	error: function(data){
			 		alert("error in saving new school head teacher =>"+data);
			 	}
			});
	}
}
//CLEAR NEW SCHOOL HEAD FORM

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
	$('#div_advisory').show();
}
function hideDivAdvisory(){
	$('#div_advisory').hide();
}
//GET ADVISORY NO ASSIGNED
function getYSAdv(){
	//showing div_advisory
	showDivAdvisory();

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
	var data1 = $('#new_adv_form').serializeArray();
	var data2 = $('#new_adv_ext_info').serializeArray();
	var obj = {'data1': JSON.stringify($('#new_adv_form').serializeArray()),'data2': JSON.stringify($('#new_adv_ext_info').serializeArray())};
	var blank1, blank2 = false;
	for(var ctr = 0;ctr<data1.length;ctr++){
		if(data1[ctr].value==="" || data1[ctr].value==="  " || data1[ctr].value===null){	
			blank1 = true;
			break;
		}
	}
	for(var ctr = 0;ctr<data2.length;ctr++){
		if(data2[ctr].value==="" || data2[ctr].value==="  " || data2[ctr].value===null){
			blank2 = true;
			break;
		}
	}		
	var checkEm = valEmailAdv();
	if((blank1) || (blank2)){
		$('#div_alert_new_adv').addClass("n_error");
		$('.a_adv_msg').html("Some information was missing.Check it!!");
	}else if(!checkEm){
		$('#new_adv_email').focus();
		$('#div_alert_new_adv').addClass("n_error");
		$('.a_adv_msg').html("Please enter a valid email address.");
	}else{
		$('#div_alert_new_adv').removeClass("n_error");
		$('.a_adv_msg').html("");
		$.ajax({
			type: 'POST',
			url: 'process/save_new_adv.php',
			data: obj,
			success: function(data){
                //console.log(data);
				if (data === "exist") {
					$('#new_adv_id_num').focus();
					$('#div_alert_new_adv').addClass("n_error");
					$('.a_adv_msg').html("ID number already exist.");
				}else{
					$('#div_alert_new_adv').removeClass("n_error");
					$('#div_alert_new_adv').removeClass("n_ok");
					$('.a_adv_msg').html("Successfully saved.");
					enabledPNA();//enabled btn_proceed_new_adv
					clearInput();//clear all field
					genIdNum();
					hideDivAdvisory();//hiding div_advisory
					disabledSNA();//disabled btn_save_new_adv
				}

			},
			error: function(data){
				alert('error in saving new adviser = > '+data);
			}
		});
	}
}

//SAVE NEW SUBJECT TEACHER
var exist = "false";

function idNumExist() {
	var obj = {"idNum": $('#new_st_id_num').val()};
	jQuery.ajax({
	   type: 'POST',
	   url: 'process/checkNSTidNum.php',
	   data: obj,
	   success: function(data){
			 if (data) {
				    $('#new_st_id_num').focus();
				    $('#div_alert_new_st').addClass("n_error");
				    $('.a_st_msg').html("ID number already exist.");
					exist = true;
			 }else{
				    $('#div_alert_new_st').removeClass("n_error");
				    $('.a_st_msg').html("");
					exist = false;
			 }
	   },
	   error: function(data){
			 console.log("error in checking id number -..- "+data);
	   }
	});
}

//VALIDATION
var notValid = false;
function valiIdNumST() {//validate id number
	   var idNum = $('#new_st_id_num').val();
	   var regex = /^[a-zA-Z0-9\-]$/;
	   var iL = idNum.length;
	   var iLN = idNum.substring(iL-1,iL);
	   if (!regex.test(iLN)) {
			 var res = idNum.substring(0,iL-1);
			 $('#new_st_id_num').val(res);
	   }
}
var regexS = /^[A-Za-z\s]/;
function valiFNameST() {
		var fName = $('.vali_fname_st').val();
		var fL = fName.length;
		if (!regexS.test(fName)) {
				var res = fName.substring(0,fL-1);
				$('.vali_fname_st').val(res);
		}
}
function valiMNameST() {
		var mname = $('.vali_mname_st').val();
		var mL = mname.length;
		if (!regexS.test(mname)) {
				var res = mname.substring(0,mL-1);
				$('.vali_mname_st').val(res);
		}
}
function valiLNameST() {
		var lname = $('.vali_lname_st').val();
		var lL = lname.length;
		if (!regexS.test(lname)) {
				var res = lname.substring(0,lL-1);
				$('.vali_lname_st').val(res);
		}
}
function valiEmailST() {
		var regexEm = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var email = $('.vali_email_st').val();
		if (!regexEm.test(email)) {
		    $('#new_st_email').focus();
			$('#div_alert_new_st').addClass("n_error");
			$('.a_st_msg').html("Invalid email address. Please enter email address");
			
			notValid = true;	
		}else{
		    notValid = false;
			$('#div_alert_new_st').removeClass("n_error");
			$('.a_st_msg').html("");
		}
}
function valiMobileST() {
		/*var regex = /^[0-9]$/;
		var mobile = $('#new_st_mobile').val();
		var mL = mobile.length;
		if (!regex.test(mobile)){
				var res = mobile.substring(0,mL-1);
				$('#new_st_mobile').val(res);
		}
		if (mL > 11) {
				var res = mobile.substring(0,11);
				$('#new_st_mobile').val(res);
		}*/
}
function valiAgeST() {
		
		/*var regexA = /^[0-9]$/;
		var ageST = $('#new_st_age').val();
		console.log(ageST);
		var aL = ageST.length;
		var aLN = ageST.substring(aL-1,aL);
		if (!regexA.test(aLN)) {
				var res = ageST.substring(0,aL-1);
				$('.#new_st_age').val(res);
		}
		if (aL > 3) {
				var res = ageST.substring(0,3);
				$('#new_st_age').val(res);
		}*/
		
		//Note: There's a problem in validating mobile number and age
}

//save new subject teacher
function saveNewST() {
		var obj = {"data":JSON.stringify($('#new_st_form').serializeArray())};
		var data = $('#new_st_form').serializeArray();
		var dataLength = data.length;
		var blank = false;
		for (var ctr = 0; ctr<dataLength; ctr++) {
				//console.log(data[ctr].value);
				if (data[ctr].value === "" || data[ctr].value === null || data[ctr].value === NaN || data[ctr].value === " ") {
						blank = true;
						break;
				}
		}
		if (blank) {
			$('#div_alert_new_st').addClass("n_error");
			$('.a_st_msg').html("Do not leave blank.");
		}else if (exist) {
			$('#new_st_id_num').focus();
			$('#div_alert_new_st').addClass("n_error");
			$('.a_st_msg').html("ID number already exist.");
		}else if (notValid) {
			$('#new_st_id_num').focus();
			$('#div_alert_new_st').addClass("n_error");
			$('.a_st_msg').html("Some data are invalid. Please check your input.");
		}else{
		    $.ajax({
				type: 'POST',
				url: 'process/save_new_st.php',
				data: obj,
				success: function(data){
						console.log(data);
						$('#div_alert_new_st').removeClass("n_error");
						$('#div_alert_new_st').addClass("n_ok");
						$('.a_st_msg').html("Successfully saved.");
						clearInput();
						genIdNum();
				},
				error: function(data){
						console.log("error in saving new subject teacher '_-_' "+data);
				}
			});
		}
}