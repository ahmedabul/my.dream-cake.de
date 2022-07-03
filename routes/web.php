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

/*Index Sarajolie*/ 
 
use App\Http\Controllers\authenticate\registerController;

Route::get('/','homeController@index')->name("home.index");

/*Register*/
Route::group(['prefix'=>'register','namespace'=>'authenticate'],function(){
  route::get('form','registerController@form')->name('register.form');
  route::post('check','registerController@check')->name('register.check');
  route::get('completeRegister','registerController@completeRegister')->name('register.completeRegister');
});
/*Login */
Route::group(['prefix'=>'login','namespace'=>'authenticate'],function(){
  route::get('form','loginController@form')->name('login.form');
  route::post('check','loginController@check')->name('login.check');
  route::get('logout','loginController@logout')->name('login.logout');
});
/*Forget Password */
Route::group(['prefix'=>'forgetPassword','namespace'=>'authenticate'],function(){
  route::get('form','forgetPasswordController@form')->name('forgetPassword.form');
  route::post('check','forgetPasswordController@check')->name('forgetPassword.check');
  route::get('completeForgetPassword','forgetPasswordController@completeForgetPassword')->name('forgetPassword.completeForgetPassword');
});
/*Category*/
Route::group(['prefix'=>'category'],function(){
  route::get('create','categoryController@create')->name('category.create');
  route::post('add','categoryController@add')->name('category.add');
  route::get('edit','categoryController@edit')->name('category.edit');
  route::get('update/categoryId','categoryController@update')->name('category.update');
  route::post('save','categoryController@save')->name('category.save');
  route::get('index/{categoryId}/{start}','categoryController@index')->name('category.index');
});
/*Article */
Route::group(['prefix'=>'article','middleware'=>'admin'],function(){
  route::get('index','articleController@index')->name('article.index');
  route::get('create','articleController@create')->name('article.create');
  route::post('store','articleController@store')->name('article.store');
  route::post('research','articleController@research')->name('article.research');
  route::get('edit/{id}','articleController@edit')->name('article.edit');
  route::post('update','articleController@update')->name('article.update');
});
/*Product*/
Route::group(['prefix'=>'product'],function(){
  route::get('index','productController@index')->name('product.index');
  route::post('show','productController@show')->name('product.show');
  route::get('myProduct/{productId}','productController@myProduct')->name('product.myProduct');
});
/*Cart*/
Route::group(['prefix'=>'cart'],function(){
  route::get('goToCart','cartController@goToCart')->name('cart.goToCart');
  route::post('addToCart','cartController@addTocart')->name('cart.addToCart');
  route::post('storeCart','cartController@storeCart')->name('cart.storeCart'); 
  route::post('removeFromCart','cartController@removeFromCart')->name('cart.removeFromCart');
});
/*Order*/
Route::group(['prefix'=>'order'],function(){
  route::post('checkLogin','orderController@checkLogin')->name('order.checkLogin');
  route::get('pay/{deliveryAddressId}','orderController@pay')->name('order.pay');
  route::get('create/{deliveryAddressId}','orderController@create')->name('order.create');
  route::get('index/{date}','orderController@index')->name('order.index')->middleware('admin');
  route::get('cancelForm/{orderId}/{email}','orderController@cancelForm')->name('order.cancelForm')->middleware('admin');
  route::post('cancel','orderController@cancel')->name('order.cancel')->middleware('admin');
  route::post('deliver','orderController@deliver')->name('order.deliver')->middleware('admin');
  route::get('ordersToDrivers','orderController@ordersToDrivers')->name('order.ordersToDrivers')->middleware('admin');
  route::post('orderDriverSave','orderController@orderDriverSave')->name('order.orderDriverSave')->middleware('admin');
  route::get('return','orderController@return')->name('order.return')->middleware('admin');
  route::get('goToResearch','orderController@goToResearch')->name('order.goToResearch')->middleware('admin');
  route::post('research','orderController@research')->name('order.research')->middleware('admin');
  route::get('show/{orderId}','orderController@show')->name('order.show')->middleware('admin');
  route::post('unlock','orderController@unlock')->name('order.unlock')->middleware('admin');
});
/*Customer Orders*/
Route::group(['prefix'=>'customer','namespace'=>'customer'],function(){
  route::get('myOrders','myOrdersController@index')->name('myOrders.index');
  route::get('acceptOrder/{answer}/{orderId}','myOrdersController@acceptOrder')->name('myOrders.acceptOrder');
  route::post('comment','myOrdersController@comment')->name('myOrders.comment');
  route::get('details/{orderId}','myOrdersController@details')->name('myOrders.details');
});
/*Customer Profile*/
Route::group(['prefix'=>'customer','namespace'=>'customer'],function(){
  route::get('myProfile','myProfileController@index')->name('myProfile.index');
  route::post('update','myProfileController@update')->name('myProfile.update');
  route::get('deliveryAddress','myProfileController@deliveryAddress')->name('myProfile.deliveryAddress');
  route::post('AddDeliveryAddress','myProfileController@addDeliveryAddress')->name('myProfile.addDeliveryAddress');
});
/*Driver*/
Route::group(['prefix'=>'driver'],function(){
  route::get('index','driverController@index')->name('driver.index')->middleware('driver');
  route::get('create','driverController@create')->name('driver.create');
  route::post('save','driverController@save')->name('driver.save');
  route::get('show','driverController@show')->name('driver.show');
  route::get('edit/{id}','driverController@edit')->name('driver.edit');
  route::post('update','driverController@update')->name('driver.update');
  route::get('deliver/{invoiceId}','driverController@deliver')->name('driver.deliver')->middleware('driver');
  route::post('deliverConfirm','driverController@deliverConfirm')->name('driver.deliverConfirm')->middleware('driver');
  route::get('deliverCancel/{orderId}','driverController@deliverCancel')->name('driver.deliverCancel')->middleware('driver');
  route::post('cancelConfirm','driverController@cancelConfirm')->name('driver.cancelConfirm')->middleware('driver');
});

/*Paypal*/
Route::group(['prefix'=>'paypal'],function(){
  route::post('index','paypalController@index')->name('paypal.index');
});
/*Error*/
Route::group(['prefix'=>'paypal'],function(){
  route::get('show/{sts}','errorController@show')->name('error.show');
});