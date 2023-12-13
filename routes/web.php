<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDesignerController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Designer\Categorycontroller;
use App\Http\Controllers\Designer\DesignerDashboardController;
use App\Http\Controllers\Designer\ProductController;
use App\Http\Controllers\language\SetLanguageController;
use App\Http\Controllers\notification\NotificationController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\registerlogin\GoogleloginController;
use App\Http\Controllers\registerlogin\registerloginController;
use App\Http\Controllers\Stripe\StripeWebhookController;
use App\Http\Controllers\Subscription\SubscriptionController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\reviewController;
use App\Http\Controllers\user\SearchController;
use App\Http\Controllers\user\ShopController;
use App\Http\Controllers\user\userDashboardController;
use App\Http\Controllers\user\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// routes/web.php
Route::get('set-language/{locale}', [SetLanguageController::class,'setLanguage'])->name('set.language');
//::::::::::::::::::::Site Pages ::::::::::::::::::::::::::://
Route::get('/', [userDashboardController::class, 'index'])->name('/');
Route::get('/shop', [ShopController::class, 'shop']);
Route::get('/single-product/{slug}', [ShopController::class, 'singleProduct'])->name('single_product');
Route::get('/contact-us', [userDashboardController::class, 'contactUs']);
Route::get('/about-us', [userDashboardController::class, 'abouttUs']);
Route::get('/explor/{slug}', [ShopController::class, 'explorecategory'])->name('explorecategory');
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//:::::::::::::::::::::::: form routes ::::::::::::::::::::::::::::::::::::::://
Route::get('/register', [registerloginController::class, 'registerpage'])->name('register');
Route::Post('/registerprocess', [registerloginController::class, 'regprocess']);
Route::get('/login', [registerloginController::class, 'loginpage'])->name('login');
Route::Post('/loginprocess', [registerloginController::class, 'loginprocess'])->name('loginprocess');
// Route::get('/add-details',[registerloginController::class,'adddetails']);

//:::::::::::::::::: google login ::::::::::::::::::::::::::::::::::::::://
Route::get('login/google', [GoogleloginController::class, 'redirectToGoogle'])->name('login_google');
Route::get('login/google/callback', [GoogleloginController::class, 'handleGoogleCallback']);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://


//:::::::::::::::::::: Admin Protected  Routes :::::::::::::::::::::::::::::::::::::://

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin-dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('AdminDashboard');
    Route::get('/admin-dashboard/user-list', [AdminDashboardController::class, 'userlist'])->name('user_list');


    //::::::::::::::: Admin profile ::::::::::::::::::::::::::::::::::::::::::::::://
    Route::get('/admin-dashboard/admin-profile', [AdminDashboardController::class, 'adminProfile']);
    Route::Post('/admin-dashboard/adminprofile-update', [ProfileController::class, 'updateAdminProfile']);
    //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::::::::::: Add Subscription ::::::::::::::::::::::::::::::::::://
    Route::get('/admin-dashboard/add-subscription',[SubscriptionController::class,'AddSubscription']);
    Route::Post('/admin-dashboard/add-subscription-process',[SubscriptionController::class,'AddSubscriptionProcess']);

    //::::::::::::::::::::::::::Category Routes::::::::::::::::::::::::::::::::://
    Route::get('/admin-dashboard/category-list', [Categorycontroller::class, 'categoryList']);
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::::::::admin notification:::::::::::::::::::::::::::::::::::::::::::://
    Route::get('/admin-dashboard/admin-notifications', [NotificationController::class, 'adminNotifications']);
    Route::get('/admin-dashboard/Mark-as-readadmin-notification', [NotificationController::class, 'adminnfread']);
    Route::get('/admin-dashboard/clear-adminNotification', [NotificationController::class, 'clearAdminnotification']);
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::::::::::::::::Designer request::::::::::::::::::::::::::::::::://
    Route::get('/admin-dashboard/designer-list', [AdminDesignerController::class, 'designerRequest']);
    Route::get('/admin-dashboard/approve-designer/{id}', [AdminDesignerController::class, 'approveDesigner'])->name('approve_designer');
    Route::post('/admin-dashboard/disapprove-designer', [AdminDesignerController::class, 'disapproveDesigner'])->name('disapprove_designer');
    Route::get('/admin-dashboard/approved-designer', [AdminDesignerController::class, 'approveddesignerlist']);
    Route::get('/admin-dashboard/disapproved-designer', [AdminDesignerController::class, 'disapproveddesignerlist']);
    //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::::::::::::::::product request::::::::::::::::::::::::::::::::://
    Route::get('/admin-dashboard/product-request', [AdminProductController::class, 'productrequest']);
    Route::get('/admin-dashboard/approve/{id}', [AdminProductController::class, 'approveProduct'])->name('approveProduct');
    Route::post('/admin-dashboard/disapproveProduct-Process', [AdminProductController::class, 'disapproveProcess'])->name('disapprove_process');
    Route::get('/admin-dashboard/product-approved', [AdminProductController::class, 'productapproved']);
    Route::get('/admin-dashboard/product-disapproved', [AdminProductController::class, 'productdisapproved']);
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
});
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::Designer Routes::::::::::::::::::::::::::::::::::::::::::://

Route::group(['middleware' => 'designer'], function () {
    Route::get('/designer-dashboard', [DesignerDashboardController::class, 'designerDashboard']);
    Route::get('/designer-dashboard/profile', [DesignerDashboardController::class, 'designerProfile']);
    

    //::::::::::::::::::::::designer notification:::::::::::::::::::::::::::::::::::::::::::://
    Route::get('/designer-dashboard/designer-notifications', [NotificationController::class, 'designerNotifications']);
    Route::get('/designer-dashboard/Mark-as-read-designer-notification', [NotificationController::class, 'designernfread']);
    Route::get('/designer-dashboard/clear-designerNotification', [NotificationController::class, 'cleardesignernotification']);
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //:::::::::::::: Approved Routes for designer ::::::::::::::::::::::::::::::::::::::::;//
    Route::group(['middleware' => 'Is_approved'], function () {

        //:::::::::::::::::::::::category routes::::::::::::::::::::::::::::::::::::://
        Route::get('/designer-dashboard/add-category', [Categorycontroller::class, 'categoryPage']);
        Route::post('/designer-dashboard/add-category-process', [Categorycontroller::class, 'addcatProcess']);
        //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

        //::::::::::::::: designer Product Routes:::::::::::::::::::::::::::::::::::::::::::::://
        Route::get('/designer-dashboard/add-product', [ProductController::class, 'productPage']);
        Route::post('/designer-dashboard/add-product-process', [ProductController::class, 'addproductProcess']);
        Route::get('/designer-Dashboard/approved-product', [ProductController::class, 'approvedproduct']);
        Route::get('/designer-Dashboard/disapproved-product', [ProductController::class, 'disapprovedproduct']);
        Route::get('/designer-Dashboard/pending-product', [ProductController::class, 'pendingproduct']);
        Route::get('/designer-dashboard/Edit-product/{id}', [ProductController::class, 'EditproductPage'])->name('EditProduct');
        Route::post('/designer-dashboard/update-product-process', [ProductController::class, 'updateProductProcess']);
    });
    //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
});

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://


//:::::::::::::::::::::: User Routes::::::::::::::::::::::::::::::::::::::::::://
Route::group(['middleware' => 'auth'], function () {


    //::::::::::::::::::::::::::: Cart  Routes ::::::::::::::::::::::::::::::::::::::://
    Route::get('/cart', [CartController::class, 'CartPage']);
    Route::Post('/add-to-cart', [CartController::class, 'AddtoCart'])->name('Add_to_Cart');
    Route::Post('/removeProduct', [CartController::class, 'removeCartProduct'])->name('remove_product');
    Route::get('/add-product-to-cart/{slug}', [CartController::class, 'Cart'])->name('Add_Cart');
    Route::post('/increase-product-quantity', [CartController::class, 'increaseProductQty'])->name('Increase_Quantity');
    Route::post('/decrease-product-quantity', [CartController::class, 'decreaseProductQty'])->name('decrease_Quantity');
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //:::::::::::::::::::::::::::::::: Wishlist Routes ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
    Route::get('/favourite', [WishlistController::class, 'favourite']);
    Route::Post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('Add_Wishlist');
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //:::::::::::::::::::::::::: review routes ::::::::::::::::::::::::://
    Route::Post('/add-review', [reviewController::class, 'AddReview']);

    //:::::::::::::::::::::::: logout route :::::::::::::::::::::::::::::::::://
    Route::get('/logout', [registerloginController::class, 'logout'])->name('logout');

    //:::::::::::::: search route ::::::::::::::::::::::::::://
    Route::post('/search',[SearchController::class,'search']);

    //::::: user Profile :::::::://
    Route::get('/user-profile',[ProfileController::class,'userProfile']);
    Route::Post('/profile-update', [ProfileController::class, 'updateProfile']);

    //::::::::::::::::: subscription Routes  :::::::::::::::::::::::::::::::://
    Route::get('/subscription',[SubscriptionController::class,'SubscriptionPage']);
    Route::get('/subscription-payment-form{id}',[SubscriptionController::class,'subscriptionForm'])->name('subscription_form');
    Route::post('/subscription-process', [SubscriptionController::class, 'subscriptionProcess']);
    Route::get('/subscription-success', [SubscriptionController::class, 'subscriptionSuccess']);
    Route::get('/subscription-fail', [SubscriptionController::class, 'subscriptionFail']);


});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::::: Webhook route :::::::::::::::://
    Route::post('/payment/webhook',[StripeWebhookController::class,'handleWebhookResponse']);

