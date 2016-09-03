<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['domain' => 'admin.foodfire.in'], function()
{


    // Route::get('searcha', array('as' => 'search', 'uses' => 'Search@main'));

});


Route::group(['domain' => 'vendor.foodfire.in'], function()
{

    // Route::get('/', 'Search@main');
    Route::get('/', array('as' => 'vendor-login', 'uses' => 'Vendor@home'));
    Route::get('reset', array('as' => 'vendor-reset', 'uses' => 'Vendor@reset'));
    Route::get('signup', array('as' => 'vendor-signup', 'uses' => 'Vendor@signup'));
    Route::post('vendor/register', array('uses' => 'Vendor@signupcall'));

    //EMAIL CONFIRMATION OF USER
    Route::get('register/verify/{confirmationCode}', ['uses' => 'Vendor@confirm']);

    //FORGOT PASSWORD -- SEND EMAIL --
    Route::post('password/reset', array('before' => 'csrf', 'uses' => 'RemindersController@postRemind'));

    //CLICK ON RESET LINK FROM EMAIL
    Route::get('password/reset/{token}', array('uses' => 'Vendor@getReset'));

    //REGISTER NEW PASSWORD FROM EMAIL RESET LINK
    Route::post('password/reset/newpasss', array('uses' => 'Vendor@postReset'));

    Route::post('login', array('uses' => 'Vendor@loginUser'));

    Route::get('dashboard', array('as' => 'admin', 'uses' => 'VendorDashboard@dashboard'));
    

});


$approute = function(){

    Route::group(array('before' => 'citysession'), function(){


        //CRON JOB
        Route::get('cron', array('uses' => 'Cron@main'));

        //HOME PAGE
        Route::get('/', array('as' => 'index','uses' => 'HomeController@home'));

        //REGISTER NEW USER
        Route::post('reg', array('before' => 'csrf', 'uses' => 'Login@newReg'));

        //LOGIN USER
        Route::post('login', array('before' => 'csrf', 'uses' => 'Login@loginUser'));

        //EMAIL CONFIRMATION OF USER
        Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'Login@confirm']);

        //USER LOGOUT
        Route::post('logout', array('before' => 'csrf', 'uses' => 'Login@logoutUser'));

        //FORGOT PASSWORD -- SEND EMAIL --
        Route::post('password/reset', array('before' => 'csrf', 'uses' => 'RemindersController@postRemind'));

        //CLICK ON RESET LINK FROM EMAIL
        Route::get('password/reset/{token}', array('uses' => 'RemindersController@getReset'));

        //REGISTER NEW PASSWORD FROM EMAIL RESET LINK
        Route::post('password/reset/{token}', array('uses' => 'RemindersController@postReset'));

        //AUTOCOMPLETE FOR SUGGESTION BOX
        Route::get('auto', 'Ajax@searchAuto');


        //GENERATE SELLER USING AJAX AUTOCOMPLETE SEARCH PAGE
        Route::get('search', array('as' => 'search', 'uses' => 'Search@main'));


        //VENDOR DATA USING AJAX CALL
        // Route::post('vendor_details', array('before' => 'csrf', 'uses' => 'Vendor@main'));

        //SEARCH PAGE RECENT ACITVITY
        Route::get('recentactivity', array('uses' => 'Search@recentActivity'));

        //VENDOR LIKE,VISIT,FAVOURITE
        Route::post('updatevalue', array('before' => 'csrf', 'uses' => 'Search@vendorupdatevalue'));

        //RENDER VENDOR ITEM PAGE
        Route::get('vendor/{city}/{vendor_url}', array('uses' => 'Search@vendoritem'));

        //AJAX QUERY FOR PRODUCTS
        Route::post('vendor/products', array('before' => 'csrf', 'uses' => 'Search@vendorproducts'));

        //AJAX QUERY TO INSERT VENDOR REVIEW
        Route::post('vendor/add/review', array('before' => 'csrf', 'uses' => 'Search@addReview'));

        //AJAX QUERY FOR PRODUCTS DEATAILS
        Route::post('vendor/product/detail', array('before' => 'csrf', 'uses' => 'ProductDetails@main'));

        //AJAX QUERY TO ADD PRODUCTS INTO CART
        Route::post('vendor/product/add', array('before' => 'csrf', 'uses' => 'Cart@add'));

        //AJAX QUERY TO DISPLAY CART
        Route::post('vendor/product/cart', array('before' => 'csrf', 'uses' => 'Cart@displayCart'));

        //AJAX QUERY TO REMOVE PRODUCT
        Route::post('vendor/product/remove', array('before' => 'csrf', 'uses' => 'Cart@removeProduct'));

        //AJAX QUERY FOR MODAL OF NEW ADDRESS
        Route::post('newaddress', array('before' => 'csrf', 'uses' => 'Address@newAddress'));

        //AJAX QUERY TO FIND AREA BY CITY
        Route::post('cityarea', array('before' => 'csrf', 'uses' => 'Address@cityArea'));

        //AJAX QUERY TO ADD NEW ADDRESS
        Route::post('address/add', array('before' => 'csrf', 'uses' => 'Address@addAddress'));

        //AJAX QUERY TO REMOVE ADDRESS
        Route::post('address/remove', array('before' => 'csrf', 'uses' => 'Address@deleteAddress'));

        //AJAX QUERY TO DEFAULT ADDRESS
        Route::post('address/default', array('before' => 'csrf', 'uses' => 'Address@defaultAddress'));

        //AJAX QUERY FOR ADDRESS UPDATE FORM
        Route::post('address/update/form', array('before' => 'csrf', 'uses' => 'Address@updateAddressForm'));

        //USER CHECKOUT FOR ORDER
        Route::get('checkout', array('as' => 'checkout','uses' => 'Checkout@main'));

        //AJAX QUERY TO ORDER
        Route::post('checkorder', array('before' => 'csrf', 'uses' => 'Checkout@finalOrderCheck'));

        //AFTER MAKING ORDER SHOW RECEIPT
        Route::get('order', array('as' => 'order', 'uses' => 'Checkout@finalOrder'));

        //"TRIAL" EMAIL TEMPLATE
        Route::get('template', array('uses' => 'Checkout@emailTemplate'));

        
        Route::group(array('before' => 'userauth'), function(){

            //USER HOME PAGE
            Route::get('user/home', array('as'=>'usershome', 'uses' => 'Users@home'));

            //USER PROFILE PAGE
            Route::get('user/profile', array('as'=>'usersprofile', 'uses' => 'Users@profile'));

            //USER ORDERS PAGE
            Route::get('user/orders', array('as'=>'usersorders', 'uses' => 'Users@orders'));

            //USER REVIEWS PAGE
            Route::get('user/reviews', array('as'=>'usersreviews', 'uses' => 'Users@reviews'));

        });


    });
};

Route::group(['domain' => 'foodfire.in'], $approute);
Route::group(['domain' => 'www.foodfire.in'], $approute);
// Route::group(['domain' => 'localhost'], $approute);



// JUST FOR TEST AS TEST LINK
Route::get('test', function(){
    return View::make('test');
});









// TEST
Route::get('the/{first?}/avenger/{second?}', array(
    'as' => 'ironman',
    function($first, $second) {
        return "Tony Stark, the {$first} avenger {$second}.";
    }
));

// TEST
Route::get('example', function()
{
    // return URL::route('ironman', array('a', 'ever'));
    //return Redirect::route('ironman', array('a','b'));
    // echo link_to_route('ironman', 'title', $parameters = array('param','av'));
    // echo route('ironman', array('a','b'));
    // return URL::route('here', array('','b'));
    $arr = array('name' => 'aashay', 'sur' => 'shah');
    echo link_to_route('here', 'title', $arr);
    //return Redirect::route('here', $arr);
});

// TEST
Route::get('here', array(
	'as' => 'here',
	function(){
		// echo URL::full();
		$aa = Input::get('name');
		echo $aa;
		// print($aa);
	// echo $a.' and '.$b;
	}
));


