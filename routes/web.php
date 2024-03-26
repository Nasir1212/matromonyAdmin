<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home_controller;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MultiUserController;
use App\Http\Controllers\Auth;

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
//Views Router 
Route::get('/', function () {
return view("pages.home.home");
})->middleware('login');

Route::get('/popup', function () {
return view("pages.popup.popup");
})->middleware('login');


Route::get('/login_view', function () {
    return view("pages.login.login");
});
Route::get('/change_password', function () {
    return view("pages.login.change_password");
});

Route::middleware('login')->controller(home_controller::class)->group(function () {
    Route::get("/show_all_register","show_all_register");  
    Route::get("/details/{id}","details");  
    Route::get("/publish","publish");  
    Route::get("/clientcontact","clientcontact");  
    Route::get("/client_message_delete/{id}","client_message_delete");  
    Route::get("/buyerpackage","buyerpackage");  
    Route::get("/delete_register/{id}","delete_register");  
    Route::post("/update_registation","update_registation");  
    Route::get("/list_register_view","list_register_view");  

});
// middleware('user_login')->

Route::middleware('login')->controller(BlogController::class)->group(function () {
    Route::get("/create_blogs_page","create_blogs_page");  
    Route::post("/create_blogs","create_blogs");  
    Route::get("/all_blog","all_blog");  
    Route::get("/edit_blog_page/{id}","edit_blog_page");  
    Route::post("/update_blog","update_blog");  
    Route::get("/delete_blog","delete_blog");  
    Route::get("/update_popup","update_popup"); //It is popup message for without biodata complete user  
    Route::get("/popup_enable_disable","popup_enable_disable"); //It is popup message for without biodata complete user  
});

Route::middleware('login')->controller(MultiUserController::class)->group(function () {
    Route::get("/multi_user_page","multi_user_page");  
    Route::get("/add_user","add_user");  
    Route::get("/user_delete","user_delete");  
    Route::get("/update_user","update_user");  

});

Route::controller(Auth::class)->group(function () {
    Route::post("/login","login");  
    Route::get("/logout","logout");  
    Route::get("/send_otp","send_otp");  
    Route::post("/checking_otp","checking_otp");  
    Route::post("/handle_change_password","handle_change_password");  
   
            
});


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});