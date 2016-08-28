// FACEBOOK API

window.fbAsyncInit = function () {

        FB.init({
            appId: '1409628666010604', // App ID
            // channelUrl: '//abtechnosys.com/food/public/', // Channel File
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true // parse XFBML
        });

    };

    function facebookLogin() {

        FB.getLoginStatus(function(response) {

            if (response.status === 'connected') {
              // connected
              getProfileImage();

            } else if (response.status === 'not_authorized') {
              //app not_authorized
              FB.login(function(response) {
                  if (response && response.status === 'connected') {
                    getProfileImage();
                  }
                });

            } else {
              // not_logged_in to Facebook
              FB.login(function(response) {
                if (response && response.status === 'connected') {
                  getProfileImage();
                }
              });
            }
      });
        
    }

    function getProfileImage() {
 
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
          //console.log('Successful login for: ' + response.name);
          // console.log(JSON.stringify(response));
          // document.getElementById('status').innerHTML =
          //   'Thanks for logging in, ' + response.name + '!';
          
          document.getElementById('name').value = response.name;
          document.getElementById('email').value = response.email;
          afterReg(response.name);
          FB.api('/me/picture?width=180&height=180', function(response) {
            //console.log('Successful login for: ' + response.name);
              // console.log(JSON.stringify(response));
              // console.log(response.data.url);
            document.getElementById("register").style.display = "none";
            document.getElementById('profile-picture').src = response.data.url;
            
            
          });

          // FB.api('/me/user_about_me', function(response){
          //    console.log(JSON.stringify(response));

          // });
          
        }); 
    }

    // Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));






// GMAIL API

// Enter a client ID for a web application from the Google Developer Console.
// The provided clientId will only work if the sample is run directly from
// https://google-api-javascript-client.googlecode.com/hg/samples/authSample.html
// In your Developer Console project, add a JavaScript origin that corresponds to the domain
// where you will be running the script.
// var clientId = '152971661266-m2vdond0tavdhcgkia5233ctem63hkll.apps.googleusercontent.com'; //shah.aashay21@gmail.com
var clientId = '1063830419013-ql90l7jjvspsri350sd2a19n9po3sm9u.apps.googleusercontent.com'; //foodfireonline@gmail.com
// var clientId = '152971661266-h31khodvi91lv9pka5jabv1as9v3o004.apps.googleusercontent.com';
// Enter the API key from the Google Develoepr Console - to handle any unauthenticated
// requests in the code.
// The provided key works for this sample only when run from
// https://google-api-javascript-client.googlecode.com/hg/samples/authSample.html
// To use in your own application, replace this API key with your own.
// var apiKey = 'AIzaSyA7ot00FDoGnjMqpYzaagrpKDe67HoohzU'; //shah.aashay21@gmail.com
var apiKey = 'AIzaSyBy7SJDy51-iP1RHHdAeiF3SRaYgtexL-I'; //foodfireonline@gmail.com
// To enter one or more authentication scopes, refer to the documentation for the API.
// var scopes = 'https://www.googleapis.com/auth/plus.me';
// var scopes = 'https://www.googleapis.com/auth/plus.login';
// var scopes = 'https://www.googleapis.com/auth/userinfo.email';
// var scopes = 'https://www.googleapis.com/auth/userinfo.profile';
// var scopes = 'https://www.googleapis.com/auth/plus.profile.emails.read';
var scopes = 'https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email';
// Use a button to handle authentication the first time.
function handleClientLoad() {
  gapi.client.setApiKey(apiKey);
  window.setTimeout(checkAuth,1);
}
function checkAuth() {
  gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
}
function handleAuthResult(authResult) {
  var authorizeButton = document.getElementById('authorize-button');
  if (authResult && !authResult.error) {
    // authorizeButton.style.visibility = 'hidden';
    makeApiCall();
  } else {
    authorizeButton.style.visibility = '';
    authorizeButton.onclick = handleAuthClick;
  }
}

function handleAuthClick(event) {
  gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
  return false;
}
// Load the API and make an API call.  Display the results on the screen.
function makeApiCall() {
  gapi.client.load('plus', 'v1', function() {
    var request = gapi.client.plus.people.get({
      'userId': 'me'
    });
    request.execute(function(resp) {
      // console.log(JSON.stringify(resp));
      document.getElementById('name').value = resp.displayName;
      document.getElementById('email').value = resp.emails[0].value;
      var photourl = resp.image.url.replace('50','200');
      document.getElementById('profile-picture').src = photourl;
      document.getElementById("register").style.display = "none";
      afterReg(resp.displayName);

    });

  });
}
