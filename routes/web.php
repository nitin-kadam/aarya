<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/','frontend\HomeController@index');
// Route::get('/about_us','frontend\HomeController@about_us');
// Route::get('/terms-conditions','frontend\HomeController@termsConditions');
// Route::get('/privacy-polocy','frontend\HomeController@privacypolocy');
// Route::get('/our-services','frontend\HomeController@our_services');
// Route::get('/details_service/{service_id}','frontend\HomeController@details_service');
// Route::get('/doctors','frontend\HomeController@doctors');
// Route::get('/gallery','frontend\HomeController@gallery');
// Route::get('/contact-us','frontend\HomeController@contact_us');
// Route::get('/blogs','frontend\HomeController@blogs');
// Route::get('/elements','frontend\HomeController@elements');
// Route::post('/processContact','frontend\HomeController@processContact');
// Route::post('/book_appoint','frontend\HomeController@book_appoint');
// Route::get('/blog-details/{blogId}','frontend\HomeController@blog_details');

Route::group(['middleware' => 'sales_auth'], function () {
    Route::get('/sales-dashboard','backend\SalesController@index');
    Route::get('/profile_sales','backend\SalesController@profile_sales');
    Route::get('/change_password_sales','backend\SalesController@change_password_sales');
    Route::post('/changePasswordactionSales','backend\SalesController@changePasswordactionSales');

});

Route::group(['middleware' => 'telecaller_auth'], function () {
    Route::get('/telecaller-dashboard','backend\TelecallerController@index');
    Route::get('/profile_telecaller','backend\TelecallerController@profile_telecaller');
    Route::get('/change_password_telecaller','backend\TelecallerController@change_password_telecaller');
    Route::get('/leads_list','backend\TelecallerController@leads_list');
    Route::get('/add_lead','backend\TelecallerController@add_lead');
    Route::post('/changePasswordactiontele','backend\TelecallerController@changePasswordactiontele');

});

Route::group(['middleware' => 'check_auth'], function () {
    Route::get('/dashboard','backend\AdminController@index');
    Route::get('/change_password','backend\AdminController@change_password');
    Route::post('/changePasswordaction','backend\AdminController@changePasswordaction');
    Route::get('/profile','backend\AdminController@profile');
    Route::get('/users','backend\AdminController@users');
    Route::get('/add_user','backend\AdminController@add_user');
    Route::post('/add_user_action','backend\AdminController@add_user_action');
    Route::get('/view_users/{user_id}','backend\AdminController@view_users');
    Route::get('/delete_users/{user_id}','backend\AdminController@delete_users');
    Route::get('/status_change_user/{user_id}/{status}','backend\AdminController@status_change_user');
    Route::get('edit_view_users/{user_id}','backend\AdminController@edit_view_users');
    Route::post('/update','backend\AdminController@update');
    Route::get('/admin_setting','backend\AdminController@admin_setting');
    Route::post('/admin_setting_update','backend\AdminController@admin_setting_update');
    Route::get('/cms_list/','backend\CmsController@cms_list');
    Route::get('/add_cms_view/','backend\CmsController@add_cms_view');
    Route::post('/add_cms_action/','backend\CmsController@add_cms_action');
    Route::get('/view_cms/{cmsid}','backend\CmsController@view_cms');
    Route::get('/edit_view_cms/{cmsid}','backend\CmsController@edit_view_cms');
    Route::post('/update_cms_action','backend\CmsController@update_cms_action');
    Route::get('/blog_list','backend\BlogController@blog_list');
    Route::get('/add_blog_view','backend\BlogController@add_blog_view');
    Route::post('/add_blog_action','backend\BlogController@add_blog_action');
    Route::get('/edit_view_blog/{blogId}','backend\BlogController@edit_view_blog');
    Route::get('/view_blog/{blogId}','backend\BlogController@view_blog');
    Route::post('/edit_action','backend\BlogController@edit_action');
    Route::get('/delete_blog/{blogId}','backend\BlogController@delete_blog');
    Route::get('/services','backend\ServiceController@services');
    Route::get('/add_service','backend\ServiceController@add_service');
    Route::post('/service_action','backend\ServiceController@service_action');
    Route::get('/view_service/{service_id}','backend\ServiceController@view_service');
    Route::get('/edit_view_service/{service_id}','backend\ServiceController@edit_view_service');
    Route::post('/service_update','backend\ServiceController@service_update');
    Route::get('/delete_service/{services_id}','backend\ServiceController@delete_service');
    Route::get('/clients_list','backend\ClientController@clients_list');
    Route::get('/add_client','backend\ClientController@add_client');
    Route::post('/client_action','backend\ClientController@client_action');
    Route::post('/get_mesage','backend\PhotosController@get_mesage');
    Route::get('/edit_view_client/{client_id}','backend\ClientController@edit_view_client');
    Route::get('/view_client/{client_id}','backend\ClientController@view_client');
    Route::get('/delete_client/{client_id}','backend\ClientController@delete_client');
    Route::post('/update_action','backend\ClientController@update_action');

});
//login controoler
Route::get('/admin','backend\LoginController@index');
Route::post('/auth-check','backend\LoginController@auth_check');
Route::get('/logout','backend\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
