var host = window.location.host;
var proto = window.location.protocol;
var ajax_url = proto+"//"+host+"/";
var ajax_form_url = proto+"//"+host;

	var arrayContains = Array.prototype.indexOf ?
    function(arr, val) {
        return arr.indexOf(val) > -1;
    } :
    function(arr, val) {
        var i = arr.length;
        while (i--) {
            if (arr[i] === val) {
                return true;
            }
        }
        return false;
    };

function logout(){
	localStorage.clear();
	window.location.href= ajax_url+'auth/logout';
}
   
function scrollbreak(){
	/*$( '.popup-messages' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
	    var e0 = e.originalEvent,
	        delta = e0.wheelDelta || -e0.detail;
	    
	    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
	    e.preventDefault();
	});*/
  
}

function scrollToDown(){
	$( '.popup-messages' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
	    var e0 = e.originalEvent,
	        delta = e0.wheelDelta || -e0.detail;
	    
	    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
	    e.preventDefault();
	});
  
}
   
function scrollbrek(){
	/*$( '.chat-sidebar' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
	    var e0 = e.originalEvent,
	        delta = e0.wheelDelta || -e0.detail;
	    
	    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
	    e.preventDefault();
	});
  return false;*/
}

  
function arrayIntersection() {
    var val, arrayCount, firstArray, i, j, intersection = [], missing;
    var arrays = Array.prototype.slice.call(arguments); // Convert arguments into a real array

    // Search for common values
    firstArr = arrays.pop();
    if (firstArr) {
        j = firstArr.length;
        arrayCount = arrays.length;
        while (j--) {
            val = firstArr[j];
            missing = false;

            // Check val is present in each remaining array 
            i = arrayCount;
            while (!missing && i--) {
                if ( !arrayContains(arrays[i], val) ) {
                    missing = true;
                }
            }
            if (!missing) {
                intersection.push(val);
            }
        }
    }
    return intersection;
}


$(function(){
	
	$.arrayIntersect = function(a, b)
	{
		return $.grep(a, function(i)
		{
			return $.inArray(i, b) > -1;
		});
	};
	



	
	$('.pro-img').hover(
		/*function(){$(this).next('.upload-icon').addClass('dBlk');},
		function(){$(this).next('.upload-icon').removeClass('dBlk');}*/
		);
	
	/*$("#aboutUsSection").click(function() {
		$('html, body').animate({
			scrollTop: $(".one_section").offset().top
		}, 2000);
	});*/
	
	var focusElement = $(".response-msg");
	$(focusElement).focus();
	//ScrollToTop(focusElement);
	
	$('.response-msg').on('click',function(){
			$(this).slideUp(1000);
	});
	setInterval(function() {
	   $('.response-msg').slideUp();}, 6000);
	
	//$('.response-msg').delay(5000);
	$(window).scroll(function()
	{
		if($(window).scrollTop() < 0)
		{
			$('#scc_ovrly_shw').css({'position':'absolute', 'top':'50px'});
			$('#err_ovrly_shw').css({'position':'absolute', 'top':'50px'});
		}
		else
		{
			$('#scc_ovrly_shw').css({'position':'fixed', 'top':'0px'});
			$('#err_ovrly_shw').css({'position':'fixed', 'top':'0px'});
		}
	});	
	
	
	$("body").on('change','#homeUniv',function() {
		filterExchange();
	});
	
	$("body").on('change','#hostUniv',function() {
		filterExchange();
	});
	
	$("body").on('keyup','#exchangeKeyword',function() {
		filterExchange();
	});
	$("body").on('change','#hostCountryC',function() {
		filterExchange();
	});
	
	$("body").on('keyup','#searchUNI',function(){
		serchUniversity();
		
	})
	
	
	$('#homeUniv').combobox();
	$('#hostUniv').combobox();
	
	$('#homeUniversityID').combobox();
	$('#hostUniversityID').combobox();
	$('#exchangeTerm').combobox();
	$('#homecountry').combobox();
	$('#hostNewcountry').combobox();
	$('#hostCountryC').combobox();
	$('#type').combobox();
	/*$('.selectType').click(function() {
		$('.selectType').removeClass('active');
		$(this).addClass('active');
		
		var typeUser = $(this).attr('data-usertype');
		
		$('#type').val(typeUser);
		
		if(typeUser=='3' || typeUser=='4') {
			$('.type3-4').hide();
		}else {
			$('.type3-4').show();
			if($("input[name='hostUniversityID']").val()!='1') {
				$('#newHostUniversityDiv').hide();
			}
		}
	});
	*/
	
	$("input[name='type']").on("change", function () {
		var typeVal = $(this).val();
		
		if (typeVal === undefined || typeVal === "") {
           
		} else {
		
		    if(typeVal=='3' || typeVal=='4') {
				$('.type3-4').hide();
			}else {
				$('.type3-4').show();
				if($("input[name='hostUniversityID']").val()!='1') {
					$('#newHostUniversityDiv').hide();
				}
			}
			//$(this).next('.input-group').find('input').focus();
        }
	 });
	
	 $("body").on("click",".glyphicon-remove",function(){
		
		if($(this).parents('.form-group').hasClass('home-univ')) {
			console.log('dg');
			$('#newHomeUniversityDiv').hide();
		}else{
		
			$(this).parents('.form-group').next().find('#hostCountry').val('');
			$(this).parents('.form-group').next().next('#newHostUniversityDiv').hide();
			$(this).parents('.form-group').next('.hostCountryBlk').show();
		}
	 });	
	
	 $("input[name='hostUniversityID']").on("change", function () {
		var hostUnivId = $(this).val();
		if (hostUnivId === undefined || hostUnivId === "") {
            $('#hostCountry').val("");
		} else {
		    if(hostUnivId=='1') {
				$('#newHostUniversityDiv').show();
				$('.hostCountryBlk').hide();
			}else{
				$('#newHostUniversityDiv').hide();
				$('.hostCountryBlk').show();
				var token = $("input[name='_token']").val();
				var id = hostUnivId;
				$.ajax({
				   type:'post',
					url: ajax_url+'university/getUniversityCountryName',
					data: {"id": id, "_token": token},
					dataType: 'json',
					success:function (response) {
						$('#hostCountry').val(response.data);
					}

				});
			}
			
        }
	 });
	 
	 
	  $("input[name='homeUniversityID']").on("change", function () {
		var homeUnivId = $(this).val();
		
		if (homeUnivId === undefined || homeUnivId === "") {
           
		} else {
		    if(homeUnivId=='1') {
				$('#newHomeUniversityDiv').show();
			}else{
				$('#newHomeUniversityDiv').hide();
			}
			
        }
	 });
	 
	 // upload profile image
	if($('#uploadImage').length>0)
	{
		var token = $("input[name='_token']").val();
		var userID = $('#uploadImage').attr('data-rel');
		console.log(userID);
		myaction = ajax_url+'users/uploadImage';
		var btnUpload=$('#uploadImage');
		var curImgSrc = $("#uploadImage").children('img').attr('src');
		var loadingImgSrc = ajax_url+'public/img/loader.gif';
		new AjaxUpload(btnUpload, {
			action: myaction,
			name: 'uploadfile',
			data: {"userId": userID, "_token": token},
			onSubmit: function(file, ext)
			{
				
				$("#uploadImage").children('img').attr('src',loadingImgSrc);
				$("#uploadImage").children('img').addClass('centerLoader');
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
				 { 
					// extension is not allowed 
					alert("Only JPG, PNG, or GIF files are allowed");
					$("#uploadImage").children('img').removeClass('centerLoader');
					$("#uploadImage").children('img').attr('src',curImgSrc);
					return false;	
				}
			},
			onComplete: function(file, response)
			{
			
				//Add uploaded file to list
				html=response.split(":");
				console.log(html);
				if($.trim(html[0])==="success")
				{
					overlayMessageShow('success','Profile image has been successfully uploaded.');
					//$("#uploadImage").attr('src',ajax_url+'img/Front/memberImages/'+html[1]);
					window.location.reload()
					
				}
				
				else
				{
					overlayMessageShow('error',html[1]);
					$("#uploadImage").children('img').removeClass('centerLoader');
					$("#uploadImage").children('img').attr('src',curImgSrc);
				}
			}
		});
	}

});

function rightTxt(param){
	 $('#rightText').html(param);
 }


function overlayShow()
{
	$('#loading_overlay').show();
	$('#loading_overlay').children().show();
}
function overlayHide()
{
	$('#loading_overlay').hide();
	$('#loading_overlay').children().hide();
}
function ScrollToTop(el) {
	 $( "html, body" ).animate({
		scrollTop: 0,
		});
	
}
// custom message
function overlayMessageShow(msgType, msg)
{
	if(msgType == 'success')
	{
		$('#custom_success_client').html(msg);
		$('#custom_success_client').show();
	}
	else if(msgType == 'error')
	{
		$('#custom_error_client').html(msg);
		$('#custom_error_client').show();
	}
}

function serchUniversity(){
	var counter = 0;
    var tempArr = new Array();
	var universityName=$('#searchUNI').val().toLowerCase();
	//console.log("input data="+universityName);
	
	$( ".unicheck" ).each(function() {
		$(this).hide();
		object = $(this);	
	
		if(universityName!='') {
			counter = counter+1;
			/* Host filter */
			var destinationUniv = object.attr( "data-university");
			
			universityName = universityName.replace('(','');
			universityName = universityName.replace(')','');
			
			
			var reEk = new RegExp(universityName);
			if (destinationUniv.match(reEk)) {
				//object.show();
				tempArr.push(object.attr('id'));
			}
		}
	});
	var tempFinalArray = new Array();	
	if(tempArr.length>0){
		tempFinalArray = $.merge( tempFinalArray, tempArr );
	}
	
	if(tempArr.length>0){
		var sorted_arr = tempFinalArray.sort();
	        //console.log('sdf');
			               
		var results = [];
		if(tempFinalArray.length>1){
			for (var i = 0; i < tempFinalArray.length - 1; i++) {
				if (sorted_arr[i + 1] == sorted_arr[i]) {
					results.push(sorted_arr[i]);
				}
			}
		}else{
			results.push(sorted_arr[0]);
		}
	}else {
		var results = tempFinalArray;
	}
		
	
	
	$.each(tempFinalArray,function(e){
		$('#'+tempFinalArray[e]).show();
	});
	

	if(!counter)
	{
		$( ".unicheck" ).show();
	}
}

function filterExchange() {
	
	var homeUniv = $('#homeUniv').val().toLowerCase();
	var hostUniv = $('#hostUniv').val().toLowerCase();
	var exchangeKeyword = $('#exchangeKeyword').val().toLowerCase();
	var hostCountryC = $('#hostCountryC').val().toLowerCase();
	

	var counter = 0;
    var tempArr = new Array();
	var tempArr1 = new Array();
	var tempArr2 = new Array();
	var tempArr3 = new Array();
	var tempFinalArray = new Array();
	
	var tempFinalArrayTest = new Array();
	
	$( ".gridView" ).each(function() {
		$(this).hide();
		object = $(this);

		if(homeUniv!='') {
			counter = counter+1;
			var destinationHome = object.attr( "data-homeuniv");
			
			homeUniv = homeUniv.replace('(','');
			homeUniv = homeUniv.replace(')','');
			var reHome = new RegExp(homeUniv);
			if (destinationHome.match(reHome)) {
				//object.show();
				tempArr.push(object.attr('id'));
			}
		}
		
		
		if(hostUniv!='') {
			counter = counter+1;
			/* Host filter */
			var destinationHost = object.attr( "data-hostuniv");
			hostUniv = hostUniv.replace('(','');
			hostUniv = hostUniv.replace(')','');
			
			
			var reHost = new RegExp(hostUniv);
			if (destinationHost.match(reHost)) {
				tempArr1.push(object.attr('id'));
				//object.show();
			}
		}
		
		if(exchangeKeyword!='') {
			counter = counter+1;
			/* Host filter */
			var destinationEkhomeUniv = object.attr( "data-homeuniv");
			var destinationEkhostUniv = object.attr( "data-hostuniv");
			var destinationEkgoing = object.attr( "data-going");
			var destinationEkStudent = object.attr( "data-student");
			var destinationEkName = object.attr( "data-name");
			//console.log("destinationEkhomeUniv= "+destinationEkhomeUniv);
			exchangeKeyword = exchangeKeyword.replace('(','');
			exchangeKeyword = exchangeKeyword.replace(')','');
			
			
			var reEk = new RegExp(exchangeKeyword);
			if (destinationEkhomeUniv.match(reEk) || destinationEkhostUniv.match(reEk) || destinationEkgoing.match(reEk) || destinationEkStudent.match(reEk) || destinationEkName.match(reEk)) {
				//object.show();
				tempArr2.push(object.attr('id'));
			}
		}
		
		
		if(hostCountryC!='') {
			counter = counter+1;
			/* Host filter */
			var destinationHostC = object.attr( "data-going");
			hostCountryC = hostCountryC.replace('(','');
			hostCountryC = hostCountryC.replace(')','');
			var reHostC = new RegExp(hostCountryC);
			if (destinationHostC.match(reHostC)) {
				tempArr3.push(object.attr('id'));
				//object.show();
			}
		}
	});	
	

	tempFinalArray.push(tempArr);

	
	if(tempArr.length>0){
			tempFinalArrayTest .push(tempArr);
	}else{
			if(homeUniv!=''){
				tempArr.push('no found home univ');
			    tempFinalArrayTest .push(tempArr);
			}
			    
			
	}
	
	if(tempArr1.length>0){
			tempFinalArrayTest .push(tempArr1);
	}else{
			if(hostUniv!=''){
				tempArr1.push('no found host univ');
			    tempFinalArrayTest .push(tempArr1);
			}
			    
			
	}
	
	if(tempArr2.length>0){
		tempFinalArrayTest .push(tempArr2);
		//tempFinalArray = $.merge( tempFinalArray, tempArr2 );
	}else{
			if(exchangeKeyword!=''){
				tempArr2.push('no found exchangeKeyword');
			    tempFinalArrayTest .push(tempArr2);
			}
			    
			
	}
	
	if(tempArr3.length>0){
			tempFinalArrayTest .push(tempArr3);
		//tempFinalArray = $.merge( tempFinalArray, tempArr3 );
	}else{
			if(hostCountryC!=''){
				tempArr3.push('no found hostCountryC');
			    tempFinalArrayTest .push(tempArr3);
			}
			    
			
	}
	console.log("tempArr="+tempArr);
	console.log("tempArr1="+tempArr1);
	console.log("tempArr2="+tempArr2);
	console.log("tempArr3="+tempArr3);
	
	var result=new Array();
	if(tempFinalArrayTest.length>0){
		result = tempFinalArrayTest.shift().filter(function(v) {
			return tempFinalArrayTest.every(function(a) {
				return a.indexOf(v) !== -1;
			});
		});
	}	
		
	
	if(tempArr1.length>0 || tempArr2.length>0 || tempArr3.length>0 ){
		var sorted_arr = tempFinalArray.sort();
	        //console.log('sdf');
			//console.log(tempFinalArray.length);                    
		var results = [];
		if(tempFinalArray.length>1){
			for (var i = 0; i < tempFinalArray.length - 1; i++) {
				if (sorted_arr[i + 1] == sorted_arr[i]) {
					results.push(sorted_arr[i]);
				}
			}
		}else{
			results.push(sorted_arr[0]);
		}
	}else {
		var results = tempFinalArray;
	}
	
	//console.log(results);  
	if(result.length>0){	
	$.each(result,function(e){
		$('#'+result[e]).show();
	});
	}else{
		
	}
	

	if(!counter)
	{
		$( ".gridView" ).show();
	}
}


function validateSubscriber() {
	var form = $("#about_sub_form");
	
	form.validate();
	
	if(form.valid()) {
		var formAction = form.attr('action');
		var email = $("#email");
		var token = $("input[name='_token']");
		var emailValue = email.val();
		var tokenValue = token.val();
		var subscriberMessageBoxDivID = "#subscriberMessageBox";
		$.ajax({
			type: "post",
			url: formAction,
			data: {"email": emailValue, "_token": tokenValue},
			dataType: 'json',
			success: function (response, textStatus, jqXHR) {
				//remove existing error classes and error messages from form groups
				if (response.success) {
					overlayMessageShow('success',response.data);
				} else {
					overlayMessageShow('error',response.data);
				}

			},
			error: function (response) {
				var errors = JSON.parse(response.responseText);
				if (response.status === 422) {
					associate_errors(errors, form);
				}
			}
		});
	}
	return false;
}
function associate_errors(errors, $form) {
	//remove existing error classes and error messages from form groups
	$form.find('.form-group').removeClass('has-feedback').removeClass('has-error').find('.help-block').text('');
	//$form.find('.form-group').find('.glyphicon').removeClass('glyphicon-remove');
	$form.find("#subscribeBtn").removeClass('btn-danger').addClass('btn-default');
	$form.find("#subscribeBtn").css('border-color', "#ccc");
	for (var key in errors) {
		//find each form group, which is given a unique id based on the form field's name
//                var $group = $form.find('#' + key + '-group');
		var $group = $form.find('#' + key);
		//$group.parent().parent().append('<span style="margin-right:6em;" class="glyphicon form-control-feedback glyphicon-remove"></span>');
		var $msg = $form.find('.' + key + '-form-group').append('<span class="help-block"> </span>');
		//add the error class and set the error text
		$msg.addClass('has-feedback').addClass('has-error').find('.help-block').text(errors[key]);
		//$form.find("#subscribeBtn").removeClass('btn-default').addClass('btn-danger');
		$form.find("#subscribeBtn").css('border-color', "#a94442");
	}
}

function sendRequest(obj) {
	
	var UID = $('#uId').val();
	var TOID = $('#toId').val();
	var REQTYPE = $('#reqType').val();
	
	var MESSAGE = $('#message').val();
	
	$('#requestForm').validate();
	if($('#requestForm').valid()) {
			$(obj).text('Processing...');
			$(obj).attr('onclick','');
			if(TOID!='' && UID!='') {
			var frm = $('#requestForm');
			
			var formAction = frm.attr('action');
		
			var token = frm.find("input[name='_token']");
		
			var tokenValue = token.val();
			var subscriberMessageBoxDivID = "#subscriberMessageBox";
			$.ajax({
				type: "post",
				url: formAction,
				data: {"reqType": REQTYPE,"toId": TOID,"uId": UID,"message": MESSAGE, "_token": tokenValue},
				dataType: 'json',
				success: function (response, textStatus, jqXHR) {
					//remove existing error classes and error messages from form groups
					if (response.success) {
						overlayMessageShow('success',response.data);
					} else {
						overlayMessageShow('error',response.data);
					}
					$(obj).text('Submit');
					$(obj).attr('onclick','return sendRequest(this);');
					$('.closeModal').trigger('click');
				},
				error: function (response) {
					var errors = JSON.parse(response.responseText);
					if (response.status === 422) {
						associate_errors(errors, form);
					}
				}
			});
		}else {
			alert('Some problem occur. Please try again!');return false;
		}
	}
	
	return false;
}


 
function loggedinUser(){
	alert('You are not able to Chat!');return false;
}

 function filterByCountry(){
	var country=$("#combobox-countrylist").val();
	
	if(country != null){
	}else{
		country = 'all';
	}
	
		var frm = $('#CntrySlct');
			var formAction = frm.attr('action');
		
			var token = frm.find("input[name='_token']");
			var tokenValue = token.val();
			
			$('#universityList').addClass('customOpacity');
			
			$.ajax({
				type: "post",
				url: formAction,
				data: {"country":country, "_token": tokenValue},
				dataType: 'json',
				success: function (response, textStatus, jqXHR) {
					//remove existing error classes and error messages from form groups
					
					if (response.success) {
						console.log(response.countData);
						if(response.countData >=0){
						
							var objects = JSON.stringify(response.data);
							var image='';
							var university = '';
							var universityname='';
							
						 $.each(response.data, function(key, item) {
								universityname=item.universityName
							university += '<div id="gridId'+item.id+'" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 unicheck"  data-university="'+universityname.toLowerCase()+'">\
						 <div class="inner_university_blck">';
										
														if(item.image !=""){
															image='<img src='+ajax_url+'public/images/universities/' +item.image+ ' />';
														}else{
															 image= '<img src='+ajax_url+'public/img/Sogang_University.gif />';
														}
													university += image;	
					university += '<div class="inner_img_block">\
														<h4> <a href="/university-detail/'+item.id+'/university"> '+item.universityName+'</a></h4>\
													</div>\
											</div>\
										</div>';
										
						});	
						
						
						$('#universityList').html(university);
						}else {
							$("#universityList").html("<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center\"><span class=\"noFound\">No record found!</span></div>");
						}
						
						
					} else {
						$("#universityList").html("<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center\"><span class=\"noFound\">No record found!</span></div>");
					}
					
					$('#universityList').removeClass('customOpacity');
					
				},
				error: function (response) {
					var errors = JSON.parse(response.responseText);
					if (response.status === 422) {
						associate_errors(errors, form);
					}
				}
			});
	
 }
 
 