<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDesignerController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Designer\Categorycontroller;
use App\Http\Controllers\Designer\DesignerDashboardController;
use App\Http\Controllers\Designer\ProductController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\notification\NotificationController;
use App\Http\Controllers\registerlogin\registerloginController;
use App\Http\Controllers\user\ShopController;
use App\Http\Controllers\user\userDashboardController;
use App\Http\Middleware\is_role;
use App\Models\Product;
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

//::::::::::::::::::::Site Pages ::::::::::::::::::::::::::://
Route::get('/',[userDashboardController::class,'index']);
Route::get('/shop',[ShopController::class,'shop']);
Route::get('/single-product',[ShopController::class,'singleProduct']);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//:::::::::::::::::::::::: form routes ::::::::::::::::::::::::::::::::::::::://
Route::get('/register',[registerloginController::class,'registerpage'])->name('register');
Route::Post('/registerprocess',[registerloginController::class,'regprocess']);
Route::get('/login',[registerloginController::class,'loginpage'])->name('login');
Route::Post('/loginprocess',[registerloginController::class,'loginprocess'])->name('loginprocess');
Route::get('/logout',[registerloginController::class,'logout'])->name('logout');

//:::::::::::::::::::: Admin Protected  Routes :::::::::::::::::::::::::::::::::::::://

Route::group(['middleware' =>  'admin'], function () {

Route::get('/admin-dashboard' ,[AdminDashboardController::class,'adminDashboard']);


//::::::::::::::: Admin profile ::::::::::::::::::::::::::::::::::::::::::::::://
Route::get('/admin-profile',[AdminDashboardController::class,'adminProfile']);
// Route::post('/')
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::::::Category Routes::::::::::::::::::::::::::::::::://
Route::get('/category-list',[Categorycontroller::class,'categoryList']);
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::admin notification:::::::::::::::::::::::::::::::::::::::::::://
Route::get('/admin-notifications',[NotificationController::class,'adminNotifications']);
Route::get('/Mark-as-readadmin-notification',[NotificationController::class,'adminnfread']);
Route::get('/clear-adminNotification',[NotificationController::class,'clearAdminnotification']);
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::::::::::Designer request::::::::::::::::::::::::::::::::://
Route::get('/designer-list',[AdminDesignerController::class,'designerRequest']);
Route::get('/approve-designer/{id}',[AdminDesignerController::class,'approveDesigner'])->name('approve_designer');
Route::post('/disapprove-designer',[AdminDesignerController::class,'disapproveDesigner'])->name('disapprove_designer');
Route::get('/approved-designer',[AdminDesignerController::class,'approveddesignerlist']);
Route::get('/disapproved-designer',[AdminDesignerController::class,'disapproveddesignerlist']);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::::::::::product request::::::::::::::::::::::::::::::::://
Route::get('/product-request',[AdminProductController::class,'productrequest']);
Route::get('/approve/{id}',[AdminProductController::class,'approveProduct'])->name('approve');
Route::post('/disapproveProduct-Process',[AdminProductController::class,'disapproveProcess'])->name('disapprove_process');
Route::get('/product-approved',[AdminProductController::class,'productapproved']);
Route::get('/product-disapproved',[AdminProductController::class,'productdisapproved']);
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
});
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::Designer Routes::::::::::::::::::::::::::::::::::::::::::://

Route::group(['middleware' =>  'designer'], function () {
Route::get('/designer-dashboard',[DesignerDashboardController::class,'designerDashboard']);

//:::::::::::::::::::::::category routes::::::::::::::::::::::::::::::::::::://
Route::get('/add-category',[Categorycontroller::class,'categoryPage']);
Route::post('/add-category-process',[Categorycontroller::class,'addcatProcess']);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::designer notification:::::::::::::::::::::::::::::::::::::::::::://
Route::get('/designer-notifications',[NotificationController::class,'designerNotifications']);
Route::get('/Mark-as-read-designer-notification',[NotificationController::class,'designernfread']);
Route::get('/clear-designerNotification',[NotificationController::class,'cleardesignernotification']);
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::: designer Product Routes:::::::::::::::::::::::::::::::::::::::::::::://
Route::get('/add-product',[ProductController::class,'productPage']);
Route::post('/add-product-process',[ProductController::class,'addproductProcess']);
Route::get('/designer-Dashboard/approved-product',[ProductController::class,'approvedproduct']);
Route::get('/designer-Dashboard/disapproved-product',[ProductController::class,'disapprovedproduct']);
Route::get('/designer-Dashboard/pending-product',[ProductController::class,'pendingproduct']);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//:::::::::::::::::::::: User Routes::::::::::::::::::::::::::::::::::::::::::://
Route::group(['middleware' =>  'Auth'], function () {


});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://





