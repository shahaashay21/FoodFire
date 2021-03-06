<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <meta name="csrf-token" content={{ csrf_token() }}>
  <meta charset="utf-8">
  <link rel="icon" href="images/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- {{ HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') }} -->
  {{ HTML::style('bootstrap-3.3.5-dist/css/bootstrap.min.css') }}
  <!-- {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/cyborg/bootstrap.min.css') }} -->
  

  <style type="text/css">
    html { 
  background: url('images/login-background.jpg') no-repeat center center; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

body {
  background: transparent;
}

body, input, button {
  font-family: 'Source Sans Pro', sans-serif;
}



.login {
  padding: 15px;
  /*width: 400px;*/
  max-width: 450px;
  min-height: 400px;
  margin: 2% auto 0 auto;
  }
.heading {
    text-align: center;
    margin-top: 1%;
  }

h2 {
  font-size: 3em;
  font-weight: 300;
  color: rgba(255, 255, 255, 0.7);
  display: inline-block;
  padding-bottom: 5px;
  text-shadow: 1px 1px 3px #23203b;
}


span {
     background: transparent;
     min-width: 53px;
     border: none;        
}
    
.input-group {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.last-of-type {
  border-top: none;
}

i {
    font-size: 1.5em;
    color: rgba(255, 255, 255, 0.2);
}

input.form-control {
  padding: 10px;
  font-size: 1.6em;
  width: 100%;
  background: transparent;
  color: lighten(#AB9E95, 50%);
  border: none;
}
input.form-control:focus{
  border: none;
}

button {
  margin-top: 20px;
  background: #27AE60;
  border: none;
  font-size: 1.6em;
  font-weight: 300;
  padding: 5px 0;
  width: 100%;
  border-radius: 3px;
  color: lighten(#27AE60, 40%);
  border-bottom: 4px solid #27AE60;
}
button:hover{
  background: tint(#27AE60, 4%);
  -webkit-animation: hop 1s;
  animation: hop 1s;
}


.float {
  display: inline-block;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
}

.float:hover, .float:focus, .float:active {
  -webkit-transform: translateY(-3px);
  transform: translateY(-3px);
}


/*1.12 START ALERT TOP NOTIFICATION*/
.alert-top-notify{
  position:absolute;
  z-index: 999;
  width:100%;
  padding: 19px;
  display: none;
}
.alert-notify-success{
  color:#3c763d;
  background-color:#dff0d8;
  border-color:#d6e9c6;
}
.alert-notify-info{
  color:#31708f;
  background-color:#d9edf7;
  border-color:#bce8f1;
}
.alert-notify-warning{
  color:#8a6d3b;
  background-color:#fcf8e3;
  border-color:#faebcc;
}
.alert-notify-danger{
  color:#a94442;
  background-color:#f2dede;
  border-color:#ebccd1;
}
/*END*/

/* Large Devices, Wide Screens */

@media only screen and (max-width : 1500px) {
}

@media only screen and (max-width : 1200px) {
  .login {
    /*width: 600px;*/
    font-size: 2em;
  }
}

@media only screen and (max-width : 1100px) {
  .login {
    margin-top: 2%;
    /*width: 600px;*/
    font-size: 1.7em;
  }
}

/* Medium Devices, Desktops */
@media only screen and (max-width : 992px) {
  .login {
    margin-top: 1%;
    /*width: 550px;*/
    font-size: 1.7em;
    min-height: 0;
  }
}

/* Small Devices, Tablets */
@media only screen and (max-width : 768px) {
  .login {
    margin-top: 0;
    /*width: 500px;*/
    font-size: 1.3em;
    min-height: 0;
  }
}

/* Extra Small Devices, Phones */ 
@media only screen and (max-width : 480px) {
  .login {
    margin-top: 0;
    /*width: 400px;*/
    font-size: 1em;
    min-height: 0;
  }
  h2 {
      margin-top: 0;
    }
}

/* Custom, iPhone Retina */ 
@media only screen and (max-width : 320px) {
  .login {
    margin-top: 0;
    width: 200px;
    font-size: 0.7em;
    min-height: 0;
  }
}



  </style>
</head>
<body>
@if(Session::has('conf'))
  <div class="alert-top-notify col-lg-12 confirm-alert"></div>
@else
  <div class="alert-top-notify suc col-lg-12"></div>
@endif

<div class="col-xs-12 login-box" style="display:none">
  <div class="login">
    <div class="heading">
      <h2>Sign in</h2>
      <form class="loginForm" method="post">

        <div class="input-group input-group-lg">
          <span class="input-group-addon" style="background: none; border:none"><i class="fa fa-user"></i></span>
          <input style="color: white" name="email" type="email" required="required" class="form-control a" placeholder="Email">
        </div>

        <div class="input-group input-group-lg">
            <span class="input-group-addon" style="background: none; border:none"><i class="fa fa-lock"></i></span>
            <input style="color: white" name="password" type="password" required="required"  class="form-control a" placeholder="Password">
        </div>

          <button type="submit" class="float">Login</button>
          <span class="call-reset"><h5 style="color: #428bca; text-decoration: none; cursor: pointer">{{ HTML::linkroute('vendor-reset','Forgot Password', array(), array('data-color'=>'#f36c20', 'class'=>'link', 'style' => 'text-decoration:none')) }}</h5></span>
          <span style="color:#999; font-size:12px;">Don't have an account yet? 
          {{ HTML::linkroute('vendor-signup','Create account', array(), array('data-color'=>'#f36c20', 'class'=>'link', 'style' => 'text-decoration:none; color: #428bca; cursor: pointer')) }}</span>
      </form>
    </div>
  </div>
</div>




  <script type="text/javascript">
    var x = document.getElementsByTagName("BODY")[0];
    x.style.height = window.innerHeight+'px';
    // // x.style.backgroundColor = "red";

  </script>

  {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}<!-- 1.8.3 -->
  {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') }}
  <!-- {{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }} -->
  <!-- {{ HTML::script('bootstrap-3.3.5-dist/js/bootstrap.min.js') }} -->
  


  <script type="text/javascript">
  
    if($(".alert-top-notify").hasClass('confirm-alert')){
      alertline('alert-notify-success','<b>Successfully veryfied your Email.</b>');
    }
    function alertline(mood,message){
      $('.alert-top-notify').removeClass('alert-notify-success alert-notify-info alert-notify-warning alert-notify-danger');
      $('.alert-top-notify').addClass(mood);
      // console.log(message);
      var messageshow = "<center><span>"+message+"</span></center>";
      // $(messageshow).appendTo('.alert-top-notify');
      $('.alert-top-notify').html(messageshow);
      // $('.alert-top-notify').show('slide',{ direction : "up"});
      $('.alert-top-notify').slideDown();
      hidealert();

      function hidealert(){
        setTimeout(function(){$('.alert-top-notify').slideUp();},5000);
      }
    }


    $(document).ready(function(){
      $('.form-control').focus(function(){
        $(this).css('box-shadow','none');
      });
      $('.login-box').show('fade');
      $('a.link').css('color','#428bca');
      $('a.link').click(function(event) {
        // Over-rides the link
        event.preventDefault();
        // Sets the new destination to the href of the link
        newLocation = this.href;
        // color = $(this).data("color");
        $('.login-box').hide('fade');

        // Delays action
        window.setTimeout(function() {
            // Redirects to new destination
            window.location = newLocation;
        }, 250);
      });


      // LOGIN FORM QUERY
      $(".loginForm").submit(function(e){
        e.preventDefault();

        var data = $('.loginForm').serializeArray();

        $.ajax({
          type: "POST",
          url: "login",
          dataType: "json",
          data: data,
          cache: false,
          success:function(response){
            console.log(response);
            if(response == "not verify"){
              alertline('alert-notify-warning','You have not verified your Email. <b>Please verify</b>');
            }
            else if(response == "Fail"){
              alertline('alert-notify-warning','<b>Wron Email or Password</b>');
            }
            else if(response == "success"){
              window.location = $(location).attr('href')+'dashboard';
            }else{
              $.each(response, function(i,item){
                alertline('alert-notify-danger','<b>'+item+'</b>');
                return false;
              });
            }
          }
        });
      });

    });

  </script>

</body>
</html>