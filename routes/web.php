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

//前台
Route::get('/',['uses' => 'BlogController@index']);
Route::any('post/{id}',['uses' =>'BlogController@post']);
Route::group(['middleware' => ['web']], function () {
    Route::any('member/login', ['uses' => 'BlogController@login']);
    Route::any('member/register', ['uses' => 'BlogController@register']);
    Route::any('member/un', ['uses' => 'BlogController@un']);
});
Route::any('category/{id}',['uses' =>'BlogController@cateGet']);


//后台
Route::group(['middleware' => ['web']], function () {
    Route::any('admin/login', ['uses' => 'AdminController@admin_login']);
    Route::any('admin/un', ['uses' => 'AdminController@adminun']);
});
Route::any('admin/index', ['uses' => 'AdminController@index']);
Route::any('admin/system', ['uses' => 'AdminController@adSystem']);
//文章管理
Route::any('admin/post', ['uses' => 'AdminController@post']);
Route::any('admin/c_post/{id}', ['uses' => 'AdminController@c_post']);
Route::any('admin/add_post', ['uses' => 'AdminController@addpost']);
Route::any('admin/d_post/{id}',['uses'=>'AdminController@delete_post']);
Route::post('/posts/image/upload', ['uses' => 'AdminController@imageUpload']);

//分类管理
Route::any('admin/cate', ['uses' => 'AdminController@getcate']);
Route::any('admin/add_cate', ['uses' => 'AdminController@addcate']);
Route::any('admin/c_cate/{id}', ['uses' => 'AdminController@c_cate']);
Route::any('admin/d_cate/{id}',['uses'=>'AdminController@delete_cate']);
//首页设置
Route::any('admin/setting',['uses'=>'AdminController@settings']);
Route::any('admin/setting_data',['uses'=>'AdminController@setting_data']);
Route::any('admin/index_banner',['uses'=>'AdminController@index_banner']);
Route::any('admin/del_img/{id}',['uses'=>'AdminController@del_img']);

//密码修改
Route::any('admin/password',['uses'=>'AdminController@c_password']);
