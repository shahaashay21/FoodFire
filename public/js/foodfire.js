// GOOGLE ANALYTIC CODE

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-67033218-1', 'auto');
ga('send', 'pageview');


//SET DEFAULT TOKEN VALUE
var token = $('meta[name="csrf-token"]').attr('content');
console.log(token);
$(document).ready(function(){

	var myCustomFlag = false;
	$('.register-click').click(function(e){
		if(myCustomFlag == false){
			$.ajax({
			  url: 'https://apis.google.com/js/client.js',
			  // url: 'https://apis.google.com/js/client.js?onload=handleClientLoad',
			  dataType: "script",
			  async: false
			});
		$.ajax({
			  url: '/js/api.js',
			  dataType: "script",
			  async: false
			});
		}
		myCustomFlag = true;
	});
	

	//IF PASSWORD RESET REDIRECTED THEN SHOW ALERT MESSAGE  --- AASHAY SHAH 9 JUN 2015 ---
	if($(".alert-top-notify").hasClass('confirm-alert')){
		alertline('alert-notify-success','<b>Successfully veryfied your Email.</b>');
	}

	//IF EMAIL PASSWORD RESET REDIRECTED THEN SHOW RESET FORM  --- AASHAY SHAH 10 JUN 2015 ---
	if($(".modal").hasClass('reset-form-modal')){
		$(".reset-form-modal").modal("show");
		//SET DEFAULT SETTINGS
		$('.inputfield').val('');
		$('.min6char').hide();
	}

	




	// CALL TO ADD HTML AT PARTICULAR PLACE  --- AASHAY SHAH 1 JUN 2015 ---
	// function ajax(code,col){
	// 	console.log(code);
	// 	$.ajax({
	//  		type: 'GET',
	//  		url: '/ajax/recipe',
	//  		data: 'code='+code+'&col='+col,
	//  		cache: false,

	//  		success:function(response){
	//  			if(code == 20001){
	// 	 			$('.'+code).append(response);
		 			
	// 			}
	//  		}
	//  	});
	// }


	// LEFT SIDE ANIMATION ON SCROLL  --- AASHAY SHAH 3 JUN 2015 ---
	if($(".container").hasClass("xds")){
		var xsa = $('.xds').offset();
		$('.xds').css("opacity","0");
		// $('.xds').hide();
		scrollXds()
		$(window).scroll(function(){
			scrollXds()
		});
	}
	function scrollXds(){
		var sc = $(this).scrollTop();
		var wind = $(window).height();
		// console.log('Window height: '+sc+ ' AND class height:'+ xsa.top);
		if(sc >= xsa.top-wind){
			$('.xds').addClass("leftt");
			$('.xds').css("opacity","1");
		}
	}




	// FIND BOOTSTRAP BREAKPOINT USING JS, INCLUDE BOOTSTRAP TOOLKIT LIB   --- AASHAY SHAH 2 JUN 2015 ---

	// var xs = 0;
	// var sm = 0;
	// var md = 0;
	// var lg = 0;
	// resizekit();
	// boottoolkit();
	// function resizekit(){
	// 	(function($, viewport){
	//     	$(window).resize(
	// 	        viewport.changed(function(){
	// 	               boottoolkit();
	// 	        })
	// 	    );
	//     })(jQuery, ResponsiveBootstrapToolkit);
	// }


	// CONTINUE

	// function boottoolkit(){
	// 	//console.log('boottoolkit');
	// 	(function($, viewport){
    
	// 	    	if(viewport.is('xs')){
	// 	    		if(xs == 0){
	// 		    		//ajax('20001','xs');
	// 		    		xs=1;
	// 	    		}
	// 	    	}
	// 	    	else if(viewport.is('sm')){
	// 	    		if(sm == 0){
	// 		    		//ajax('20001','sm');
	// 		    		sm=1;
	// 	    		}
	// 	    	}
	// 	    	else if(viewport.is('md')){
	// 	    		if(md == 0){
	// 		    		//ajax('20001','md');
	// 		    		md=1;
	// 	    		}
	// 	    	}
	// 	    	else{
	// 	    		if(lg == 0){
	// 		    		//ajax('20001','lg');
	// 		    		lg=1;
	// 	    		}
	// 	    	}

	// 	})(jQuery, ResponsiveBootstrapToolkit);
	// }

	

	//Initialize input field
	$('.form-control').val('');

	// FOR MOBILE LEFT SLIDE  --- AASHAY SHAH 5 JUN 2015  ---
    $(".open-left-slide").click(function() {
	    $(".left_slide").toggle("slide",100);
    });
	
	$(".header_left-slide_close").click(function() {
        $(".left_slide").hide("slide",100);
    });

	// MENU DROP DOWN/UP  --- AASHAY SHAH 5 JUN 2015  ---
    $('.dropdown-hover').hover(function(){ 
		$('.dropdown-menu', this).stop().slideToggle(300); 
	});


    //Check to see if the window is top if not then display GOTO TOP button   --- AASHAY SHAH 5 JUN 2015  ---
	$(window).scroll(function(){
		if ($(this).scrollTop() > 230) {
			$('.scrollTop').fadeIn();
		} else {
			$('.scrollTop').fadeOut();
		}
	});
	
	//Click event to scroll to top   --- AASHAY SHAH 5 JUN 2015  ---
	$('.scrollTop').click(function(){
		$('html, body').animate({scrollTop : 0},700);
	});


	//START RECIPES HOVER EFFECT   --- AASHAY SHAH 6 JUN 2015
	
	$('.recipe-round').hover(function(){
		$('.recipe-round').removeClass('recipe-round-active');
		$(this).addClass('recipe-round-active');
	});
	
		
	$('.recipe-round1').hover(function(){
		hidetext();
		$('.text1').show();
	});
	$('.recipe-round2').hover(function(){
		hidetext();
		$('.text2').show();
	});
	$('.recipe-round3').hover(function(){
		hidetext();
		$('.text3').show();
	});
	$('.recipe-round4').hover(function(){
		hidetext();
		$('.text4').show();
	});
	$('.recipe-round5').hover(function(){
		hidetext();
		$('.text5').show();
	});
	$('.recipe-round6').hover(function(){
		hidetext();
		$('.text6').show();
	});
	$('.recipe-round7').hover(function(){
		hidetext();
		$('.text7').show();
	});

	function hidetext(){
		$('.text1').hide();$('.text2').hide();$('.text4').hide();
		$('.text5').hide();$('.text6').hide();$('.text7').hide();$('.text3').hide();
	}
	
	// END


	// WHEN OPEN REGISTER MODAL  --- AASHAY SHAH 3 JUN 2015  ---
	$('.register-click, .mob-register-click').click(function(){
		//SET DEFAULT SETTINGS
		$('#profile-picture').hide();
		$('#register').show();
		$('.inputfield').val('');
		$('.regAjaxLoading').hide();
		$('#mobile').removeClass('inputerr inputsuc');
		$('#mobile').css('margin-bottom','20px');
		$('#pass').removeClass('inputerr inputsuc');
		$('#name').removeClass('inputerr inputsuc');
		$('#email').removeClass('inputerr inputsuc');
		$('.min6char').hide();
		$('.mobmin6char').hide();
		$('.inp-syb').hide();
		$('.inp-syb').removeClass('glyphicon-ok glyphicon-remove');
		$('.emailregistered').css('visibility','hidden');
	});


	// REGISTER VALIDATION
	$('#name').on('keyup click focus blur change', function(){
		nullFieldValidation('name');
	});

	$('#pass').on('keyup click focus blur change', function(){
		nullFieldValidation('pass');
	});

	$('#mobile').on('keyup click focus blur change', function(){
		nullFieldValidation('mobile');
	});

	$('#email').on('keyup click focus blur change', function(){
		nullFieldValidation('email');
	});



	//WHEN OPEN LOGIN MODAL --- AASHAY SHAH 8 JUN 2015  ---
	$(".login-click").click(function(){
		//SET DEFAULT SETTINGS
		$('.inputfield').val('');
		$('#email-login').removeClass('inputerr inputsuc');
		$('#pass-login').removeClass('inputerr inputsuc');
		$('#pass-login').css('margin-bottom','20px');
		$('.min6char').hide();
		$('.inp-syb').hide();
		$('.inp-syb').removeClass('glyphicon-ok glyphicon-remove');
		$(".wrong-cred").hide();
		$('.regAjaxLoading').hide();
	});

	$('#email-login').on('keyup click focus blur change', function(){
		nullFieldValidation('email-login');
	});
	$('#pass-login').on('keyup click focus blur change', function(){
		nullFieldValidation('pass-login');
	});


	//FOR FORGOT PASSWORD MODAL  --- AASHAY SHAH 9 JUN 2015  ---
	$(".forgot-password").click(function(){
		$(".login-modal").modal('hide');
		$(".reset-modal").modal('show');
		$('.regAjaxLoading').hide();
		$('.inputfield').val('');
		$('#email-reset').removeClass('inputerr inputsuc');
		$('.inp-syb').hide();
		$('.inp-syb').removeClass('glyphicon-ok glyphicon-remove');
	});

	$('#email-reset').on('keyup click focus blur change', function(){
		nullFieldValidation('email-reset');
	});


	//NEW PASSWORD MODAL ---  AASHAY SHAH 10 JUN 2015  ---
	$('#email-reset-form').on('keyup click focus blur change', function(){
		nullFieldValidation('email-reset-form');
	});
	$('#pass-reset-form').on('keyup click focus blur change', function(){
		nullFieldValidation('pass-reset-form');
		nullFieldValidation('conf-pass-reset-form');
	});
	$('#conf-pass-reset-form').on('keyup click focus blur change', function(){
		nullFieldValidation('conf-pass-reset-form');
	});

	// SEARCH BOX SUGGESTIION
	// var key = [48,49,50,51,52,53,54,55,56,57,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,61,173,8,219,220,221,222,59,188,190,191,192]
	// $('#search').on('keyup', function(e){
	// 	if(jQuery.inArray(e.keyCode,key) != -1){

	// 		var search = document.getElementById("search").value;
	// 	 	$.ajax({
	// 	 		type: 'GET',
	// 	 		url: '/search',
	// 	 		data: 'q='+search,
	// 	 		dataType: 'json',
	// 	 		cache: false,

	// 	 		success:function(response){
	// 	 			console.log(response);
	// 	 		}
	// 	 	});
	// 	}
	// });



	//SEARCH BOX SUGGESTION OF SELLER USING AUTOCOMPLETE JS AND CSS LIB
	$("#search").autocomplete("auto", {
		selectFirst: true,
		width: 299,
		cacheLength: 10,
		scroll: false,
		delay: 400,
	});


	// SEARCH PAGE TOGGLE SEARCH BOX
	$(".togg-search").click(function(){
		$(".search-slide").slideToggle();
	});

	//FILTERING EFFECT FOR BUTTON IN SEARCH PAGE (NAME, PRICE, RATING)
	$(".filter-effect").click(function(){
		$(".filter-effect").removeClass("btn-filter-effect");
		$(this).addClass("btn-filter-effect");
	});
	

});




function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}


// AFTER GOOGLE AND FB API REGISTRATION CALL THIS FUNCTION
function afterReg(username){
	$('#profile-picture').show();
	$('#mobile').addClass('inputerr');
	$('#pass').addClass('inputerr');
	$('#email').addClass('inputsuc');
	$('#name').addClass('inputerr');
	$('.email-glyphicon').addClass('glyphicon-ok');
	$('.email-glyphicon').show();
	$('.email-glyphicon').css('color','#3c763d');
	
	if(username){
		$('#name').removeClass('inputerr');
		$('#name').addClass('inputsuc');
		$('.name-glyphicon').addClass('glyphicon-ok');
		$('.name-glyphicon').show();
		$('.name-glyphicon').css('color','#3c763d');	
	}
	
}

// CHECK NULL FIELD
function nullFieldValidation(id){
	var idname = '#'+id;
	var idvalue = $(idname).val();
	var err = 0;
	var glyphicon = '.'+id+'-glyphicon';
	// console.log(glyphicon);

	// FOR PASSWORD MIN LENGTH 6
	if(id == 'pass' || id == 'pass-reset-form'){
		if(idvalue.length < 6){
			// if(id == 'pass-login'){
				$(idname).css('margin-bottom','0px');
			// }
			$('.min6char').show();
			err = 1;
		}else{
			// if(id == 'pass-login'){
				$(idname).css('margin-bottom','20px');
			// }
			$('.min6char').hide();
			err = 0;
		}
	}
	// END

	// FOR MOBILE NUMBER MINIMUM LENGTH 6 AND SHOULD BE NUMBER
	if(id == 'mobile'){
		if(idvalue.length < 6){
			$(idname).css('margin-bottom','0px');
			$('.mobmin6char').show();
			err = 1;
		}else{
			if(isNaN(idvalue)){
				$(idname).css('margin-bottom','0px');
				$('.mobmin6char').show();
				err = 1;
			}else{
				$(idname).css('margin-bottom','20px');
				$('.mobmin6char').hide();
				err = 0;
			}	
		}
		
	}
	// END

	// VALIDATING EMAIL ID
	if(id == 'email' || id == 'email-login' || id == 'email-reset' || id == 'email-reset-form' || id == 'email-login1'){
		var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
		if (reg.test(idvalue)){
			err = 0;
		}
		else{
			err = 1;
		}
	}

	if(id == 'conf-pass-reset-form'){
		var passvalue = $('#pass-reset-form').val();
		if(idvalue == passvalue){
			err = 0;
		}else{
			err = 1;
		}
	}

	// IF ANY ERROR
	if(idvalue == null || idvalue == '' || err == 1){
		$(idname).removeClass('inputsuc');
		$(idname).addClass('inputerr');
		$(glyphicon).removeClass('glyphicon-ok');
		$(glyphicon).addClass('glyphicon-remove');
		$(glyphicon).css('color','#a94442');
		$(glyphicon).show();
	}else{
		$(idname).removeClass('inputerr');
		$(idname).addClass('inputsuc');
		$(glyphicon).removeClass('glyphicon-remove');
		$(glyphicon).addClass('glyphicon-ok');
		$(glyphicon).css('color','#3c763d');
		$(glyphicon).show();
	}
}


// VALIDATE EMAIL ID
function validateEmail(email)
{
	var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
	if (reg.test(email)){
	return true; }
	else{
	return false;
	}
}

// CHECK BEFORE REGISTER
function registerSubmit(){
	// console.log('reg-submit');
	var err = 0;
	if($('#name').hasClass('inputsuc') && $('#mobile').hasClass('inputsuc') && $('#email').hasClass('inputsuc') && $('#pass').hasClass('inputsuc')){
		return true;
	}else{
		nullFieldValidation('name');
		nullFieldValidation('mobile');
		nullFieldValidation('pass');
		nullFieldValidation('email');
		return false;
	}
}


//CHECK BEFOR LOGIN 8 JUN 2015
function loginSubmit(){
	if( ($("#email-login").hasClass('inputsuc') && $("#pass-login").hasClass('inputsuc')) || ($("#email-login1").hasClass('inputsuc') && $("#pass-login1").hasClass('inputsuc')) ){
		return true;
	}else{
		nullFieldValidation('email-login');
		nullFieldValidation('pass-login');

		nullFieldValidation('email-login1');
		nullFieldValidation('pass-login1');
		return false;
	}
}


// WHEN SUBMIT PASSWORD RESET FORM, AJAX CALL  --- AASHAY SHAH 9 JUN 2015  ---
function resetSubmit(){
	if($('#email-reset').hasClass('inputsuc')){
		return true;
	}else{
		nullFieldValidation('email-reset');
		return false;
	}
}


//WHEN NEW PASSWORD FORM WILL BE SUBMITTED  --- AASHAY SHAH 10 JUN 2015 ---
function newpassSubmit(){
	if($("#email-reset-form").hasClass('inputsuc') && $('#pass-reset-form').hasClass('inputsuc') && $('#conf-pass-reset-form').hasClass('inputsuc')){
		return true;
	}else{
		nullFieldValidation('email-reset-form');
		nullFieldValidation('pass-reset-form');
		nullFieldValidation('conf-pass-reset-form');
		return false;
	}

}

//UPDATE LIKE,FAVOURITE AND VISIT STATUS
function updatevalue(vendorid,codeid,val){
	if(codeid=='2'){
		var data = '_token='+token+'&vendorid='+vendorid+'&codeid='+codeid+'&val='+val;
	}else{
		var data = '_token='+token+'&vendorid='+vendorid+'&codeid='+codeid;
	}
	$.ajax({
 		type: 'POST',
 		url: '/updatevalue',
 		data: data,
 		dataType: "json",
 		cache: false,
 		success:function(response){
 			if(response == 'login fail'){
 				alertline("alert-notify-danger","<b>You must Log In or create an account to save</b>");
 			}else if(response == 'ok'){
 				alertline("alert-notify-success","<b>Congratulations! Successfully updated!</b>");
 				if(codeid == 1){
 					var vendlike = $("#vendor-like-"+vendorid).html();
	 				var like = Number(vendlike)+1;
	 				// $(".like-ico-"+vendorid).css("color", "#db2e2e");
 				}else if(codeid == 3){
 					var vendfavourite = $("#vendor-favourite-"+vendorid).html();
	 				var favourite = Number(vendfavourite)+1;
	 				// $(".favourite-ico-"+vendorid).css("color", "#db2e2e");
 				}else if(codeid == 4){
 					var vendvisit = $("#vendor-visit-"+vendorid).html();
	 				var visit = Number(vendvisit)+1;
	 				// $(".visit-ico-"+vendorid).css("color", "#db2e2e");
 				}else if(codeid == 2){
 					userrate = val;
 					ratecolourin((val)-1);
 				}
 			}else if(response == 'remove'){
 				alertline("alert-notify-info","<b>Successfully removed!</b>");
 				if(codeid == 1){
 					var vendlike = $("#vendor-like-"+vendorid).html();
	 				var like = Number(vendlike)-1;
	 				if(like<0){
	 					like = 0;
	 				}
	 				// $(".like-ico-"+vendorid).css("color", "#000");
 				}else if(codeid == 3){
 					var vendfavourite = $("#vendor-favourite-"+vendorid).html();
	 				var favourite = Number(vendfavourite)-1;
	 				if(favourite<0){
	 					favourite = 0;
	 				}
	 				// $(".favourite-ico-"+vendorid).css("color", "#000");
 				}else if(codeid == 4){
 					var vendvisit = $("#vendor-visit-"+vendorid).html();
	 				var visit = Number(vendvisit)-1;
	 				if(visit<0){
	 					visit = 0;
	 				}
	 				// $(".visit-ico-"+vendorid).css("color", "#000");
 				}else if(codeid == 2){
 					resetratecolour();
 				}
 			}
 			$('#vendor-like-'+vendorid).html(like);
 			$('#vendor-favourite-'+vendorid).html(favourite);
 			$('#vendor-visit-'+vendorid).html(visit);

 			// FOR MOB IN ITEM PAGE
 			$('#mobvendor-like-'+vendorid).html(like);
 			$('#mobvendor-favourite-'+vendorid).html(favourite);
 			$('#mobvendor-visit-'+vendorid).html(visit);
 		}
 	});
}


//GET PRODUCT DETAILS
function productDetail(id){
	var productdetail = $.ajax({
	 		type: 'POST',
	 		url: '/vendor/product/detail',
	 		data: '_token='+token+'&productid='+id,
	 		dataType: "json",
	 		timeout: 4000,
	 		beforeSend:function(){
	 			
	 		},
	 		success:function(response){
	 			// console.log(response['modal']);
	 			if(response['modal'] == 1){
	 				$('#prodetail').html(response['product']);

	 				$('#productModal').modal('hide');
	 				$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();
					$('body').css('padding-right','0px');

	 				$('#productModal').modal('show');
	 			}
	 			productdetail.abort();
	 		},
	 		error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           productDetail(id);
		        } 
		    }
	});
}

displayCart();

//DISPLAY CART
function displayCart(){

	var dispalyCart = $.ajax({
	 		type: 'POST',
	 		url: '/vendor/product/cart',
	 		data: '_token='+token,
	 		dataType: "json",
	 		timeout: 4000,
	 		beforeSend:function(){
	 			$('#wrap-sticky').html('<ul class="spinner"><li></li><li></li><li></li><li></li><li></li></ul>');
	 		},
	 		success:function(response){
	 			// console.log(response);
	 			// if(response['modal'] == 1){
	 				// $('#prodetail').html(response['product']);
	 				var url = $(location).attr('href');
	 				console.log(response['qty']);
	 				if(response['qty'] == 0){
	 					if(url.lastIndexOf("/checkout")+1){
	 						window.location="/";
	 						return;
	 					}
	 				}
	 				$('#wrap-sticky .spinner').hide();
	 				$('#wrap-sticky').html(response['cart']);
	 				if(url.lastIndexOf("/checkout")+1){
	 					if(response['qty'] == 0){
	 						window.location="/";
	 					}
	 					$('.cart-vendor-details').css("max-height","none");
	 					$('.cart-vendor').append('<div class="cart-seller">\
				  				<div class="row">\
				  					<div class="col-sm-6 hidden-xs">\
					  					<a href="/search" class="btn btn-primary cart-checkout">\
					  						More Hungry\
					  					</a>\
					  				</div>\
					  				<div class="col-sm-6 hidden-xs">\
					  					<a onclick="finalOrder();" class="btn btn-success cart-checkout">\
					  						Place Order\
					  					</a>\
					  				</div>\
					  				\
					  				<div class="visible-xs col-xs-6">\
					  					<a href="/search" style="font-size:13px" class="btn btn-primary cart-checkout">\
					  						More Hungry\
					  					</a>\
					  				</div>\
					  				<div class="visible-xs col-xs-6">\
					  					<a onclick="finalOrder()" style="font-size:13px" class="btn btn-success cart-checkout">\
					  						Place Order\
					  					</a>\
					  				</div>\
				  				</div>\
				  			</div>');
	 				}else{
	 					$('.cart-vendor').append('<div class="cart-seller">\
				  				<div class="row">\
				  					<a href="/checkout" class="btn btn-success cart-checkout">\
				  						Checkout\
				  					</a>\
				  				</div>\
				  			</div>');
	 				}
	 				$('#productModal').modal('hide');
	 				$('.product-total').html(response['qty']);
	 				$('.product-total-price').html('<i class="fa fa-inr"></i>'+ response['total']);
	 				if(response['total']){
	 					$('.cart-dropdown').addClass('dropdown-menu');
	 				}else{
	 					$('.cart-dropdown').removeClass('dropdown-menu');
	 				}
	 				if($(window).height() > 590){
	 					if(url.lastIndexOf("/vendor/")+1){
	 						// alert(url);
	 						$("#wrap-sticky").sticky({topSpacing:-10,bottomSpacing:120, getWidthFrom: '#product-cart' });	
	 					}
	 					
			 		}
	 			// }

	 			if(!('ontouchstart' in window))
				{
				  $('[data-toggle="tooltip"]').tooltip();
				}
	 			dispalyCart.abort();
	 		},
	 		error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           $.ajax(this);
		        } 
		    }
	});
}


//ADD PRODUCTS INTO CART
function addProduct(){
	var product = $('.itemForm').serializeArray();
	product.push({name: '_token', value: token});

	// console.log(product);
	var addproductreq = $.ajax({
	 		type: 'POST',
	 		url: '/vendor/product/add',
	 		data: product,
	 		dataType: "json",
	 		timeout: 4000,
	 		success:function(response){
	 			// console.log(response);
	 			// if(response['modal'] == 1){
	 				// $('#prodetail').html(response['product']);
	 				$('#wrap-sticky').html(response['cart']);
	 				$('#productModal').modal('hide');
	 				$('.product-total').html(response['qty']);
	 			// }
	 			displayCart();
	 			addproductreq.abort();
	 		},
	 		error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           addProduct();
		        } 
		    }
	});	
	return false;
}

//DELETE PRODUCTS FROM CART
function delProduct(data){

	var deleteproduct = $.ajax({
	 		type: 'POST',
	 		url: '/vendor/product/remove',
	 		data: '_token='+token+'&item='+data,
	 		dataType: "json",
	 		timeout: 4000,
	 		beforeSend:function(){
	 			
	 		},
	 		success:function(response){
	 				displayCart();
	 			deleteproduct.abort();
	 		},
	 		error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           delProduct(data);
		        } 
		    }
	});
}

//FETCH MODAL OF NEW ADDRESS
function newAddress(){
	var newaddress = $.ajax({
		type: 'POST',
		url: '/newaddress',
		data: '_token='+token,
		dataType: 'json',
		timeout: 4000,
		success:function(response){
			newaddress.abort();
			$('.newaddressbox').html(response);
			$('#newaddress').modal('hide');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
			$('body').css('padding-right','0px');
			$('#newaddress').modal('show');

			if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
				 $("#newaddress .modal-body").css("max-height","400px");
				 $("#newaddress .modal-body").css("overflow","auto");
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
	        if(textStatus=="timeout") {
	           $.ajax(this);
	        } 
	    }
	});

}

//REMOVE ADDRESS
function addressOperation(addid,operation){
	if(operation == 1){
		// UPDATE ADDRESS
		var updateaddress = $.ajax({
			type: 'POST',
			url: '/address/update/form',
			data: '_token='+token+'&addid='+addid,
			dataType: 'json',
			timeout: 4000,
			success:function(response){
				$('.updateaddressbox').html(response);
				$('#updateaddress').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('body').css('padding-right','0px');
				$('#updateaddress').modal('show');

				if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
					 $("#updateaddress .modal-body").css("max-height","400px");
					 $("#updateaddress .modal-body").css("overflow","auto");
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           $.ajax(this);
		        } 
		    }
		});

	}else if(operation == 2){
		// REMOVE ADDRESS
		var removeaddress = $.ajax({
			type: 'POST',
			url: '/address/remove',
			data: '_token='+token+'&addid='+addid,
			dataType: 'json',
			timeout: 4000,
			success:function(response){
				$('.addresslist').html(response);
				tooltipOn();
			},
			error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           $.ajax(this);
		        } 
		    }
		});

	}else if(operation == 3){
		// MAKE ADDRESS AS DEFAULT
		var defaultaddress = $.ajax({
			type: 'POST',
			url: '/address/default',
			data: '_token='+token+'&addid='+addid,
			dataType: 'json',
			timeout: 4000,
			success:function(response){
				$('.addresslist').html(response);
				tooltipOn();
			},
			error: function(jqXHR, textStatus, errorThrown) {
		        if(textStatus=="timeout") {
		           $.ajax(this);
		        } 
		    }
		});
	}
	
}


//FINAL ORDER OF USER
function finalOrder(){
	var data = [];

	var address = $(":input[name='address']:checked").val();
	var payment = $(":input[name='payment']:checked").val();


	$.ajax({
		type: "POST",
		url: "/checkorder",
		dataType: "json",
		data: '_token='+token+'&address='+address+'&payment='+payment,
		cache: false,
		success:function(response){
			if(response['redirect']){
				window.location = response['redirect'];
			}
			if(response["alert"]){
				alertline(response["alerttype"],"<b>"+response["message"]+"</b>");
			}
		}
	});	
}


//BOTTOM PART (ALWAYS REMAIN IT TO BOTTOM)

//INTIALIZE TOOLTIP	
if(!('ontouchstart' in window))
{
  $('[data-toggle="tooltip"]').tooltip();
}

function tooltipOn(){
	if(!('ontouchstart' in window))
	{
	  $('[data-toggle="tooltip"]').tooltip();
	}
}

//SOLVE DEFAULT MODAL SETTING ERROR
$('.modal').on('show.bs.modal', function () {
    $('body').css('padding-right','0px');
});
