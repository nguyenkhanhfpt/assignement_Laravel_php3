<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

Route::get('/', 'HomeController@index')->name('home')->middleware('checkStatus');

Route::get('/products', 'ProductController@index')->name('products');

Route::get('/products/find', 'ProductController@find')->name('findProducts');

Route::get('/products/{id}', 'ProductController@viewProduct')->name('viewProduct');

// giỏ hàng
Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/cart/viewCart', 'CartController@viewCart')->name('viewCart');

Route::post('/cart/checkQuantity', 'CartController@checkQuantityPro');

Route::get('/cart/checkSizeColor/{id}', 'CartController@checkSizeColor');

Route::post('/cart/addCart', 'CartController@addCart')->name('addCart');

Route::patch('/cart/update/{idCart}/{idProduct}', 'CartController@undateCart');

Route::get('/cart/delete/{id}', 'CartController@deleteCart');

// thanh toán
Route::get('/checkout', 'BillController@index')->name('checkout');

Route::post('/checkout', 'BillController@checkoutCart');

Route::post('/checkout/checkCode', 'BillController@checkCode');


// Comment
Route::post('/addComment', 'CommentController@addComment')->name('addComment');

Route::delete('/comment/{comment}', 'CommentController@deleteComment')->name('comment.destroy')->middleware('auth');


// Account
Route::get('/account', 'AccountController@index')->name('account');

Route::post('/account/updateProfile', 'AccountController@updateProfile')->name('updateProfile');

Route::post('/account/updatePassword', 'AccountController@updatePassword')->name('updatePassword');

// Yêu thích
Route::get('/wishlist', 'WishlistController@index')->name('wishlist');

Route::get('/wishlist/delete/{wishlist}', 'WishlistController@deleteWish');

Route::post('/wishlist/add', 'WishlistController@addWish');

// news 
Route::get('/news', 'NewsController@index')->name('news');

// send Mail
Route::post('/sendMailContact', 'SendMailContact@sendMail')->name('sendMailContact');

Route::get('notifications', 'HomeController@getNotifications');

Route::patch('notification/{id}', 'HomeController@markReadNotify');

Route::patch('notifications', 'HomeController@markReadAllNotify');

// Login with google 
Route::get('auth/redirect/{provider}', 'Auth\LoginSocialite@redirect')->name('auth_redirect');
Route::get('auth/callback/{provider}', 'Auth\LoginSocialite@callback');


Auth::routes();

Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('languale');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'checkRole']], function() {
    // Admin
    Route::get('/', 'HomeController@index')->name('admin');

    Route::get('/update', 'HomeController@updateDom');


    // Admin category 
    Route::get('/category', 'CategoryController@index')->name('adminCategory');

    Route::get('/category/add', 'CategoryController@viewAdd')->name('adminCategoryAdd');

    Route::delete('/category/{id_category}', 'CategoryController@deleteCategory');

    Route::get('/category/{id_category}/edit', 'CategoryController@edit');

    Route::patch('/category/{id_category}', 'CategoryController@updateCategory');

    Route::post('/category/add', 'CategoryController@addCategory');

    // Admin color
    Route::resource('/colors', 'ColorController')->except(['show']);

    // Admin size
    Route::resource('/sizes', 'SizeController')->except(['show']);

    // Admin product
    Route::get('/products', 'ProductController@index')->name('adminProduct');

    Route::post('/uploadFile', 'ImageLibrary@store')->name('uploadImage');

    Route::get('/uploadFile', 'ImageLibrary@index');

    Route::get('/products/add', 'ProductController@viewAdd')->name('adminProductAdd');

    Route::delete('/products/{id}', 'ProductController@delete');

    Route::get('/products/update/{id}', 'ProductController@viewUpdate');

    Route::patch('/products/update/{id}', 'ProductController@update');

    Route::post('/products/add', 'ProductController@insert');

    // Admin Member
    Route::get('/members', 'MemberController@index')->name('adminMember');

    Route::get('/members/notCheck/{id}', 'MemberController@updateStatus0');
    
    Route::patch('/members/{member}', 'MemberController@updateStatus');

    Route::delete('/members/{member}', 'MemberController@deleteMember');

    Route::get('/members/{member}', 'MemberController@viewMember');


    // Admin Comment
    Route::get('/comments', 'CommentController@index')->name('adminComment');

    Route::get('/comments/{product}', 'CommentController@show');
    
    Route::delete('/comments/{id}', 'CommentController@deleteComment');


    // Code
    Route::resource('/codes', 'CodeController')->only(['index', 'store', 'destroy']);

    // Admin Bills
    Route::get('/bills', 'BillController@index')->name('adminBill');

    Route::get('/bills/{id}', 'BillController@viewBill');

    Route::get('/bills/delete/{id}', 'BillController@deleteBill');

    Route::patch('/bills/update', 'BillController@update')->name('updateBill');

    // news
    Route::resource('/news', 'NewsController');
});
