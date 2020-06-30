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

Route::get('/comment/delete/{id}', 'CommentController@deleteComment')->middleware('auth');


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




Auth::routes();



Route::middleware(['auth', 'checkRole'])->group(function () {
    // Admin
    Route::get('/admin', 'adminController@index')->name('admin');

    Route::get('/admin/category', 'adminCategoryController@index')->name('adminCategory');


    // Admin category 
    Route::get('/admin/category/add', 'adminCategoryController@viewAdd')->name('adminCategoryAdd');

    Route::get('/admin/category/delete/{id_category}', 'adminCategoryController@deleteCategory');

    Route::get('/admin/category/update/{id_category}', 'adminCategoryController@viewUpdate');

    Route::post('/admin/category/update/{id_category}', 'adminCategoryController@updateCategory');

    Route::post('/admin/category/add', 'adminCategoryController@addCategory');


    // Admin product
    Route::get('/admin/products', 'adminProductController@index')->name('adminProduct');

    Route::get('/admin/products/add', 'adminProductController@viewAdd')->name('adminProductAdd');

    Route::get('/admin/products/delete/{id}', 'adminProductController@delete');

    Route::get('/admin/products/update/{id}', 'adminProductController@viewUpdate');

    Route::post('/admin/products/update/{id}', 'adminProductController@update');

    Route::post('admin/products/add', 'adminProductController@insert');


    // Admin Member
    Route::get('/admin/members', 'adminMemberController@index')->name('adminMember');

    Route::get('/admin/members/notCheck/{id}', 'adminMemberController@updateStatus0');
    
    Route::get('/admin/members/checked/{id}', 'adminMemberController@updateStatus1');

    Route::get('/admin/members/delete/{id}', 'adminMemberController@deleteMember');

    Route::get('/admin/members/{id}', 'adminMemberController@viewMember');


    // Admin Comment
    Route::get('/admin/comments', 'adminCommentController@index')->name('adminComment');
    
    Route::get('/admin/comments/delete/{id}', 'adminCommentController@deleteComment');


    // Admin Bills
    Route::get('/admin/bills', 'adminBillController@index')->name('adminBill');

    Route::get('/admin/bills/{id}', 'adminBillController@viewBill');

    Route::get('/admin/bills/delete/{id}', 'adminBillController@deleteBill');

    Route::post('/admin/bills/update', 'adminBillController@updateBill')->name('updateBill');
});




