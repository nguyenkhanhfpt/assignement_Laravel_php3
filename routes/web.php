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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@index')->name('products');

Route::get('/products/find', 'ProductController@find')->name('findProducts');

Route::get('/products/{id}', 'ProductController@viewProduct');

// giỏ hàng
Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/cart/viewCart', 'CartController@viewCart')->name('viewCart');

Route::post('/cart/checkQuantity', 'CartController@checkQuantityPro');

Route::post('/cart/addCart', 'CartController@addCart')->name('addCart');

Route::post('/cart/update', 'CartController@undateCart');

Route::get('/cart/delete/{id}', 'CartController@deleteCart');

// thanh toán
Route::get('/checkout', 'BillController@checkoutCart')->name('checkout');


// Comment
Route::post('/addComment', 'CommentController@addComment')->name('addComment')->middleware('checkLoginComment');

Route::get('/comment/delete/{id}', 'CommentController@deleteComment')->name('comment.destroy')->middleware('auth');


// Account
Route::get('/account', 'AccountController@index')->name('account');

Route::post('/account/updateProfile', 'AccountController@updateProfile')->name('updateProfile');

Route::post('/account/updatePassword', 'AccountController@updatePassword')->name('updatePassword');

// Yêu thích
Route::get('/wishlist', 'WishlistController@index')->name('wishlist');

Route::get('/wishlist/delete/{id}', 'WishlistController@deleteWish');

Route::post('/wishlist/add', 'WishlistController@addWish');


// send Mail
Route::post('/sendMailContact', 'SendMailContact@sendMail')->name('sendMailContact');


// Login with google 
Route::get('auth/redirect/{provider}', 'Auth\LoginSocialite@redirect')->name('auth_redirect');
Route::get('auth/callback/{provider}', 'Auth\LoginSocialite@callback');


Auth::routes();

Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('languale');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'checkRole']], function() {
    // Admin
    Route::get('/', 'HomeController@index')->name('admin');

    // Admin category 
    Route::get('/category', 'CategoryController@index')->name('adminCategory');

    Route::get('/category/add', 'CategoryController@viewAdd')->name('adminCategoryAdd');

    Route::get('/category/delete/{id_category}', 'CategoryController@deleteCategory');

    Route::get('/category/update/{id_category}', 'CategoryController@viewUpdate');

    Route::post('/category/update/{id_category}', 'CategoryController@updateCategory');

    Route::post('/category/add', 'CategoryController@addCategory');


    // Admin product
    Route::get('/products', 'ProductController@index')->name('adminProduct');

    Route::get('/products/add', 'ProductController@viewAdd')->name('adminProductAdd');

    Route::get('/products/delete/{id}', 'ProductController@delete');

    Route::get('/products/update/{id}', 'ProductController@viewUpdate');

    Route::post('/products/update/{id}', 'ProductController@update');

    Route::post('/products/add', 'ProductController@insert');


    // Admin Member
    Route::get('/members', 'MemberController@index')->name('adminMember');

    Route::get('/members/notCheck/{id}', 'MemberController@updateStatus0');
    
    Route::get('/members/checked/{id}', 'MemberController@updateStatus1');

    Route::get('/members/delete/{id}', 'MemberController@deleteMember');

    Route::get('/members/{id}', 'MemberController@viewMember');


    // Admin Comment
    Route::get('/comments', 'CommentController@index')->name('adminComment');
    
    Route::get('/comments/delete/{id}', 'CommentController@deleteComment');


    // Admin Bills
    Route::get('/bills', 'BillController@index')->name('adminBill');

    Route::get('/bills/{id}', 'BillController@viewBill');

    Route::get('/bills/delete/{id}', 'BillController@deleteBill');

    Route::post('/bills/update', 'BillController@updateBill')->name('updateBill');
});

// RestAPI
Route::get('/api/products', 'RestAPIController@selectAllProduct');

Route::post('/api/product', 'RestAPIController@selectOneProduct');

Route::delete('api/product/{id}', 'RestAPIController@deleteProduct');




