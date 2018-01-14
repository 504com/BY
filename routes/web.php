<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['domain' => config('url.admin')], function()
{

	Route::group(['namespace' => 'Manager'], function()
	{
		Route::group(['middleware' => 'auth:admin'], function () {
			Route::get('/', ['uses' => 'ManagerController@index', 'as' => 'manager.index']);
			Route::get('/chart', ['uses' => 'ManagerController@chartYear', 'as' => 'manager.show'])->middleware('cors');
			Route::get('/restaurants', ['uses' => 'RestaurantController@index', 'as' => 'manager.restaurants.index']);
			Route::post('/restaurants', ['uses' => 'RestaurantController@create', 'as' => 'manager.restaurants.create']);
			Route::patch('/restaurants', ['uses' => 'ManageFrontController@update', 'as' => 'manager.restaurants.update']);
			Route::get('/restaurant/show/{id}', ['uses' => 'RestaurantController@show', 'as' => 'manager.restaurants.show'])->where('id', '[0-9]+');
			Route::get('/restaurant/show/chart/{id}', ['uses' => 'RestaurantController@chartYear', 'as' => 'manager.chart.show'])->middleware('cors')->where('id', '[0-9]+');
			Route::get('/orders', ['uses' => 'OrderController@index', 'as' => 'manager.orders.index']);
			Route::get('/orders/show/{id}', ['uses' => 'OrderController@show', 'as' => 'manager.orders.show']);
			Route::get('/bookings', ['uses' => 'BookingController@index', 'as' => 'manager.bookings.index']);
			Route::get('/bookings/show/{id}', ['uses' => 'BookingController@show', 'as' => 'manager.bookings.show']);
			Route::get('/users', ['uses' => 'UserController@index', 'as' => 'manager.user.index']);
			Route::get('/managefront', ['uses' => 'ManageFrontController@index', 'as' => 'manager.managefront.index']);
			Route::put('/managefront', ['uses' => 'ManageFrontController@edit', 'as' => 'manager.managefront.edit']);
			Route::get('/changePassword', ['uses' => 'ChangePasswordController@index', 'as' => 'manager.changepassword.index']);
			Route::post('/changePassword', ['uses' => 'ChangePasswordController@update', 'as' => 'manager.changepassword.update']);
		});

		Route::get('/login', ['uses' => 'LoginController@showLoginForm', 'as' => 'manager-login-form']);
		Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'manager-login-submit']);
        Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'manager-logout']);
	});
});

Route::group(['domain' => config('url.restaurant')], function()
{
    Route::group(['namespace' => 'Admin'], function()
    {
		Route::group(['middleware' => 'guest'], function () {
			Route::get('/password/reset', ['uses' => 'ForgotPasswordController@showLinkRequestForm', 'as' => 'reset.password.index']);
			Route::post('/password/email', ['uses' => 'ForgotPasswordController@sendResetLinkEmail', 'as' => 'reset.password.edit']);
			Route::get('/password/reset/{token}', ['uses' => 'ResetPasswordController@showResetForm', 'as' => 'reset.password.show']);
			Route::post('/password/reset', ['uses' => 'ResetPasswordController@reset', 'as' => 'reset.password.update']);
		});

        Route::group(['middleware' => 'auth:restaurant'], function () {
            Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
			Route::get('/bilan', ['uses' => 'BilanController@index', 'as' => 'admin.bilan.index']);
			Route::get('/bilan/chart', ['uses' => 'BilanController@chartYear', 'as' => 'admin.bilan.show'])->middleware('cors');
			Route::get('/bookings/destroy/{id}', ['uses' => 'BookingController@destroy', 'as' => 'admin.bookings.destroy'])->where('id', '[0-9]+');
			Route::get('/bookings/show/{id}', ['uses' => 'BookingController@show', 'as' => 'admin.bookings.show'])->where('id', '[0-9]+');
            Route::get('/orders', ['uses' => 'OrderController@index', 'as' => 'admin.orders.index']);
            Route::get('/orders/{order}', ['uses' => 'OrderController@show', 'as' => 'admin.orders.show']);
            Route::get('/orders/destroy/{id}', ['uses' => 'OrderController@destroy', 'as' => 'admin.orders.destroy'])->where('id', '[0-9]+');
			Route::get('/infos', ['uses' => 'InfoController@show', 'as' => 'admin.infos.show']);
			Route::get('/modifications', ['uses' => 'ModificationController@show', 'as' => 'admin.modifications.show']);
			Route::post('/modifications', ['uses' => 'ModificationController@edit', 'as' => 'admin.modifications.edit']);
			Route::get('/notification', ['uses' => 'AdminController@notification', 'as' => 'admin.notification.show'])->middleware('cors');
			Route::get('/categories', ['uses' => 'CategoryController@show', 'as' => 'admin.categories.show']);
			Route::post('/categories', ['uses' => 'CategoryController@create', 'as' => 'admin.categories.create']);
			Route::put('/categories', ['uses' => 'CategoryController@edit', 'as' => 'admin.categories.edit']);
			Route::get('/categories/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'admin.categories.destroy']);
			Route::get('/products', ['uses' => 'ProductController@show', 'as' => 'admin.products.show']);
			Route::get('/products/get', ['uses' => 'ProductController@test', 'as' => 'admin.products.test']);
			Route::post('/products', ['uses' => 'ProductController@create', 'as' => 'admin.products.create']);
			Route::put('/products', ['uses' => 'ProductController@edit', 'as' => 'admin.products.edit']);
			Route::get('/products/{id}', ['uses' => 'ProductController@destroy', 'as' => 'admin.products.destroy'])->where('id', '[0-9]+');
			Route::get('/workhours', ['uses' => 'WorkhourController@show', 'as' => 'admin.workhours.show']);
			Route::get('/workhours/form', ['uses' => 'WorkhourController@getForm', 'as' => 'admin.form.workhours']);
			Route::post('/workhours', ['uses' => 'WorkhourController@create', 'as' => 'admin.workhours.create']);
			Route::get('/workhours/destroy/{id}', ['uses' => 'WorkhourController@destroy', 'as' => 'admin.workhours.destroy'])->where('id', '[0-9]+');
			Route::get('/password', ['uses' => 'PasswordController@index', 'as' => 'admin.password.index']);
			Route::post('/password', ['uses' => 'PasswordController@edit', 'as' => 'admin.password.edit']);
			Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'admin-logout']);

        });
        Route::get('/login', ['uses' => 'LoginController@showLoginForm', 'as' => 'admin-login-form']);
		Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'admin-login-submit']);
        Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'admin-logout']);

    });

});

Route::group(['domain' => config('url.front')], function()
{
    Route::get('/', ['uses' => 'DefaultController@index', 'as' => 'home']);
    Route::get('/products/{id}', ['uses' => 'ProductController@show', 'as' => 'products.show'])->middleware('cors');
    Route::get('/workhours/{id}', ['uses' => 'WorkhourController@show', 'as' => 'workhours.show'])->middleware('cors');
    Route::get('/workhours/{id}/day/{day}', ['uses' => 'WorkhourController@index','as' => 'workhours.index']);

    Route::group(['namespace' => 'Auth'], function()
    {
        Route::get('/login', ['uses' => 'LoginController@showLoginForm', 'as' => 'login-form']);
        Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'login-submit']);
        Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);
        Route::post('/register', ['uses' => 'RegisterController@register', 'as' => 'register-submit']);
//        Route::get('/auth/facebook', ['uses' => 'LoginController@redirectToProvider', 'as' => 'fb-login']);
//        Route::get('/auth/facebook/callback', ['uses' => 'LoginController@handleProviderCallback', 'as' => 'fb-login-callback']);
    });

    Route::group(['namespace' => 'Restaurant'], function()
    {
        Route::get('/restaurants/location/{geohash}', ['uses' => 'RestaurantController@index', 'as' => 'restaurants.index']);
        Route::get('/restaurants/{slug}', ['uses' => 'RestaurantController@find', 'as' => 'restaurants.show']);
        Route::get('/restaurants/{id}/tables/availabilities', ['uses' => 'RestaurantController@checkAvailabilities', 'as' => 'tables-availabilities']);
        Route::resource('restaurants.bookings', 'BookingController');
        Route::resource('restaurants.categories', 'CategoryController');
        Route::resource('restaurants.services', 'ServiceController');
        Route::resource('restaurants.payments', 'PaymentController');

		Route::group(['middleware' => 'guest'], function () {
			Route::get('/password/reset', ['uses' => 'ForgotPasswordController@showLinkRequestForm', 'as' => 'reset.usersPassword.index']);
			Route::post('/password/email', ['uses' => 'ForgotPasswordController@sendResetLinkEmail', 'as' => 'reset.usersPassword.edit']);
			Route::get('/password/reset/{token}', ['uses' => 'ResetPasswordController@showResetForm', 'as' => 'reset.usersPassword.show']);
			Route::post('/password/reset', ['uses' => 'ResetPasswordController@reset', 'as' => 'reset.usersPassword.update']);
		});
    });

    Route::group(['namespace' => 'Order'], function()
    {
        Route::get('/cart', ['uses' => 'CartController@view', 'as' => 'cart.view']);
        Route::get('/checkout', ['uses' => 'OrderController@checkout', 'as' => 'order.checkout']);
        Route::post('/restaurants/{id}/order/store', ['uses' => 'OrderController@store', 'as' => 'order.store']);
        Route::post('/payment/store/order/{order}', ['uses' => 'PaymentController@store', 'as' => 'payment.store']);
        Route::get('/payment/cancel', ['uses' => 'PaymentController@cancel', 'as' => 'payment.cancel']);
        Route::get('/payment/success', ['uses' => 'PaymentController@success', 'as' => 'payment.success']);
    });
});
