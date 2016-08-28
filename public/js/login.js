$(document).ready(function(){
	// FORM REGISTRATION QUERY
	$('.regForm').submit(function(e){
		e.preventDefault();
		// var uname = $('#name').val();
		var data = $('.regForm').serializeArray();
		// console.log(data);
		//var da = 'name='+uname;
		//$('.regAjaxLoading').show();
		// $('.emailregistered').show();
		$.ajax({
			type: "POST",
			url: '/reg',
			dataType: 'json',
			data: data,
			cache: false,
			beforeSend:function(){
				$('.regAjaxLoading').show();
			},
			success:function(response){
				//consoleClear();
				console.log(response);
				$('.regAjaxLoading').hide();
				
				if(response == 'Registered')
				{
					$('.emailregistered').css('visibility','hidden');
					$('.register-modal').modal('hide');
					alertline('alert-notify-success','<b>Successfully Registered.</b> Activation link has been sent to your Email Id.');
				}else if(response == 'Network Problem')
				{
					$('.emailregistered').css('visibility','hidden');
					$('.register-modal').modal('hide');
					alertline('.alert-notify-info','<b>Network Problem.</b> Please try again.');
				}
				if(response.email){
					var email = response.email.join();
					// console.log(email);
					if(email.search('ER') != -1){
						$('.emailregistered').css('visibility','visible');
						$("#email").removeClass('inputsuc');
						$("#email").addClass('inputerr');
						$(".email-glyphicon").removeClass('glyphicon-ok');
						$(".email-glyphicon").addClass('glyphicon-remove');
						$(".email-glyphicon").css('color','#a94442');
						$(".email-glyphicon").show();
					}else{
						$('.emailregistered').css('visibility','hidden');
						$("#email").removeClass('inputerr');
						$("#email").addClass('inputsuc');
						$(".email-glyphicon").removeClass('glyphicon-remove');
						$(".email-glyphicon").addClass('glyphicon-ok');
						$(".email-glyphicon").css('color','#3c763d');
						$(".email-glyphicon").show();
					}
				}

				

			}
		});
	});

	// LOGIN FORM QUERY
	$(".loginForm").submit(function(e){
		e.preventDefault();

		var data = $('.loginForm').serializeArray();

		$.ajax({
			type: "POST",
			url: "/login",
			dataType: "json",
			data: data,
			cache: false,
			beforeSend:function(){
				$('.regAjaxLoading').show();
				$(".wrong-cred").hide();
			},
			success:function(response){
				$('.regAjaxLoading').hide();
				if(response == "not verify"){
					$(".login-modal").modal('hide');
					alertline('alert-notify-warning','You have not verified your Email. <b>Please verify</b>');
				}
				else if(response == "Fail"){
					$(".wrong-cred").show();
				}
				else{
					var url = $(location).attr('href');
					if(url.indexOf("/checkout")+1){
						// location.reload();
						window.location=url;
					}
					$(".login-modal").modal('hide');
					$(".php-log-out").hide();
					$(".php-log-in").hide();
					$(".ajax-logged-in").show();
					$(".ajax-logged-out").hide();
					$(".mob-user-name").html("<i class='fa fa-user fa-fw'></i>");
					$(".user-name").html(toTitleCase(response)+' <i class="fa fa-caret-down"></i>');
					displayCart();
				}
			}
		});
	});

	// USER LOGOUT  --- AASHAY SHAH 8 JUN 2015 ---
	$(".logout").click(function(){
		$.ajax({
			type: "POST",
			url: "/logout",
			dataType: "json",
			data: { _token: $('[name="csrf-token"]').attr('content') },

			success:function(response){
				var url = $(location).attr('href');
				if(url.indexOf("/user")+1){
					// location.reload();
					window.location=url;
				}
				if(response == "Logged out"){
					$(".php-log-out").hide();
					$(".php-log-in").hide();
					$(".ajax-logged-in").hide();
					$(".ajax-logged-out").show();
					displayCart();
					
				}
			}
		})
	});


	// WHEN SUBMIT PASSWORD RESET FORM, AJAX CALL  --- AASHAY SHAH 9 JUN 2015  ---
	$(".resetForm").submit(function(e){

		e.preventDefault();

		var data = $('.resetForm').serializeArray();

		$.ajax({
			type: "POST",
			url: "/password/reset",
			dataType: "json",
			data: data,
			beforeSend:function(){
				$('.regAjaxLoading').show();
			},
			success:function(response){
				$(".reset-modal").modal('hide');
				$('.regAjaxLoading').hide();
				if(response == "invalid email"){
					alertline("alert-notify-danger","<b>Wrong Email Id.</b>");
				}else if(response == "reminder sent"){
					alertline("alert-notify-success","<b>Password reset link</b> has been sent to your Email");
				}else{
					alertline("alert-notify-danger","Network connection problem");
				}
			}
		});
	});



	//WHEN NEW PASSWORD FORM WILL BE SUBMITTED  --- AASHAY SHAH 10 JUN 2015 ---
	$(".reset-form-Form").submit(function(e){

		e.preventDefault();

		var data = $('.reset-form-Form').serializeArray();
		// console.log(data[0].value);
		$.ajax({
			type: "POST",
			url: "/password/reset/"+data[0].value,
			dataType: "json",
			data: data,
			aync: false,
			success:function(response){
				$(".reset-form-modal").modal('hide');
				$('.regAjaxLoading').hide();
				if(response == 'invalid password'){
					alertline("alert-notify-danger","<b>Invalid Password</b>");
				}
				else if(response == "invalid token"){
					alertline("alert-notify-danger","<b>Invalid/Old Reset Link</b>");
				}else if(response == 'invalid user'){
					alertline("alert-notify-danger","<b>Invalid Email Address</b>");
				}
				else if(response == "YES"){
					alertline("alert-notify-success","<b>Password</b> Has Been Changed");
				}else{
					alertline("alert-notify-danger","Network connection problem");
				}
			}
		});
	});

});


function alertline(mood,message){
	//$('.alert-top-notify').slideUp(0);
	$('.alert-top-notify').removeClass('alert-notify-success alert-notify-info alert-notify-warning alert-notify-danger');
	$('.alert-top-notify').addClass(mood);
	// console.log(message);
	var messageshow = "<center><span>"+message+"</span></center>";
	// $(messageshow).appendTo('.alert-top-notify');
	$('.alert-top-notify').html(messageshow);
	// $('.alert-top-notify').show('slide',{ direction : "up"});
	console.log($('.alert-top-notify').is(':visible'));
	if($('.alert-top-notify').is(':visible')){

	}else{
		$('.alert-top-notify').slideDown();
	}
	// hidealert();
	setTimeout(function(){$('.alert-top-notify').slideUp();},5000);

	function hidealert(){
		// setTimeout(function(){$('.alert-top-notify').slideUp();},5000);
	}
}