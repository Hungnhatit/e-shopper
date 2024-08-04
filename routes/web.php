<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\BlogController as ApiBlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\BlogCommentController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\BlogRateController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Auth::routes();
Route::group([
    'middleware' => ['admin']
], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/home', [DashboardController::class, 'index']);
    Route::get('/error', [App\Http\Controllers\HomeController::class, 'errorPage']);
    Route::get('/form-basic', [App\Http\Controllers\Admin\UserController::class, 'formBasic']);
    Route::get('/table', [App\Http\Controllers\HomeController::class, 'table']);
    Route::get('/icon', [App\Http\Controllers\HomeController::class, 'icon']);
    Route::get('/blank', [App\Http\Controllers\HomeController::class, 'blank']);

    // Admin profile
    Route::get('/profile-page/{id}', [UserController::class, 'index']);
    Route::post('/profile-page/{id}', [UserController::class, 'update']);
    Route::get('/logout', [LoginController::class, 'logout']);

    // Country
    Route::get('/country', [CountryController::class, 'index']);
    Route::get('/add-a-country', [CountryController::class, 'create']);
    Route::post('/add-a-country', [CountryController::class, 'store']);
    Route::get('/country/edit/{id}', [CountryController::class, 'edit']);
    Route::post('/country/update/{id}', [CountryController::class, 'update']);
    Route::delete('/delete-country/{id}', [CountryController::class, 'destroy']);

    // Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/create', [BlogController::class, 'create']);
    Route::post('/blog/create', [BlogController::class, 'store']);
    Route::get('blog/edit/{id}', [BlogController::class, 'edit']);
    Route::post('/blog/update/{id}', [BlogController::class, 'update']);
    Route::delete('/delete-blog/{id}', [BlogController::class, 'destroy']);
});

Route::group([
    'middleware' => ['isLogin']
], function () {
    Route::get('/ecommerce/login', [MemberController::class, 'index'])->name('member-login');
    Route::post('/ecommerce/login', [MemberController::class, 'login']);
});


Route::group([
    'middleware' => ['member']
], function () {
    Route::get('/ecommerce', [ProductController::class, 'show']);
    // Member
    Route::get('/ecommerce/register', [MemberController::class, 'registerIndex']);
    Route::post('/ecommerce/register', [MemberController::class, 'register']);
    Route::get('/ecommerce/account', [MemberController::class, 'edit']);
    Route::post('/ecommerce/account/update/{id}', [MemberController::class, 'update']);
    Route::post('/ecommerce/logout', [MemberController::class, 'logout'])->name('logout');

    //Blog
    Route::get('/ecommerce/blog-list', [FrontendBlogController::class, 'index']);
    Route::get('/ecommerce/blog-list/blog/{id}', [FrontendBlogController::class, 'detail'])->name('blog-detail');
    Route::post('/ecommerce/blog/rate', [BlogRateController::class, 'store'])->name('blog.rate');

    // Blog - Comment
    Route::post('/blog-comment/{id}', [BlogCommentController::class, 'postComment']);
    Route::post('/blog-comment/reply-comment/{id}', [BlogCommentController::class, 'replyComment']);


    // Product
    Route::get('/ecommerce/my-product', [ProductController::class, 'index']);
    Route::get('/ecommerce/add-product-form', [ProductController::class, 'create']);
    Route::post('/ecommerce/add-product', [ProductController::class, 'store']);
    Route::get('/ecommerce/edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('/ecommerce/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/ecommerce/product-detail/{id}', [ProductController::class, 'detail']);
    Route::delete('/ecommerce/product/delete/{id}', [ProductController::class, 'destroy']);

    // Cart
    Route::get('/ecommerce/cart', [CartController::class, 'index']);
    Route::post('/ecommerce/add-to-cart', [CartController::class, 'add'])->name('add-cart');
    Route::post('/ecommerce/update-cart', [CartController::class, 'update'])->name('update-cart');
    Route::post('/ecommerce/remove-cart-item', [CartController::class, 'removeCartItem'])->name('remove-cart-item');
    Route::post('/ecommerce/remove-all-cart', [CartController::class, 'clearCart'])->name('delete-cart');
    Route::get('ecommerce/cart/checkout', [CartController::class, 'checkout']);

    // Mail
    Route::post('/send-mail', [MailController::class, 'index']);
    Route::get('/notify', [MailController::class, 'notify']);
    Route::get('confirm-email', function () {
        return view('frontend.mail.content');
    });

    //Search
    Route::post('/ecommerce/search', [SearchController::class, 'index']);
    Route::post('/ecommerce/search-advance', [SearchController::class, 'searchAdvance']);
    Route::get('/ecommerce/fetch-products/', [SearchController::class, 'fetchProduct'])->name('fetch-products');
});

// Route::group([
//     'prefix' => 'api',
// ], function () {
//     Route::get('/blog', [ApiBlogController::class, 'index']);
// });

//Frontend

// // Member
// Route::get('/ecommerce/login', [MemberController::class, 'index'])->name('member-login');
// Route::get('/ecommerce/register', [MemberController::class, 'registerIndex']);
// Route::post('/ecommerce/register', [MemberController::class, 'register']);
// Route::post('/ecommerce/login', [MemberController::class, 'login']);
// Route::get('/ecommerce/account', [MemberController::class, 'edit']);
// Route::post('/ecommerce/account/update/{id}', [MemberController::class, 'update']);
// Route::post('/ecommerce/logout', [MemberController::class, 'logout'])->name('logout');

// //Blog
// Route::get('/ecommerce/blog-list', [FrontendBlogController::class, 'index']);
// Route::get('/ecommerce/blog-list/blog/{id}', [FrontendBlogController::class, 'detail'])->name('blog-detail');
// Route::post('/ecommerce/blog/rate', [BlogRateController::class, 'store'])->name('blog.rate');

// // Blog - Comment
// Route::post('/blog-comment/{id}', [BlogCommentController::class, 'postComment']);
// Route::post('/blog-comment/reply-comment/{id}', [BlogCommentController::class, 'replyComment']);


// // Product
// Route::get('/ecommerce/my-product', [ProductController::class, 'index']);
// Route::get('/ecommerce/add-product-form', [ProductController::class, 'create']);
// Route::post('/ecommerce/add-product', [ProductController::class, 'store']);
// Route::get('/ecommerce/edit-product/{id}', [ProductController::class, 'edit']);
// Route::post('/ecommerce/update-product/{id}', [ProductController::class, 'update']);
// Route::get('/ecommerce/product-detail/{id}', [ProductController::class, 'detail']);
// Route::delete('/ecommerce/product/delete/{id}', [ProductController::class, 'destroy']);

// // Cart
// Route::get('/ecommerce/cart', [CartController::class, 'index']);
// Route::post('/ecommerce/add-to-cart', [CartController::class, 'add'])->name('add-cart');
// Route::post('/ecommerce/update-cart', [CartController::class, 'update'])->name('update-cart');
// Route::post('/ecommerce/remove-cart-item', [CartController::class, 'removeCartItem'])->name('remove-cart-item');
// Route::post('/ecommerce/remove-all-cart', [CartController::class, 'clearCart'])->name('delete-cart');
// Route::get('ecommerce/cart/checkout', [CartController::class, 'checkout']);

// // Mail
// Route::post('/send-mail', [MailController::class, 'index']);
// Route::get('/notify', [MailController::class, 'notify']);
// Route::get('confirm-email', function () {
//     return view('frontend.mail.content');
// });

// //Search
// Route::post('/ecommerce/search', [SearchController::class, 'index']);
// Route::post('/ecommerce/search-advance', [SearchController::class, 'searchAdvance']);
// Route::get('/ecommerce/fetch-products/', [SearchController::class, 'fetchProduct'])->name('fetch-products');
