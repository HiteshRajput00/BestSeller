<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\admin\adminDesignerController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\Designer\Categorycontroller;
use App\Http\Controllers\Designer\DesignerDashboardController;
use App\Http\Controllers\Designer\ProductController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\registerlogin\registerloginController;
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

//:::::::::::::::::::::::: form routes ::::::::::::::::::::::::::::::::::::::://
Route::get('/register',[registerloginController::class,'registerpage'])->name('register');
Route::Post('/registerprocess',[registerloginController::class,'regprocess']);
Route::get('/login',[registerloginController::class,'loginpage'])->name('login');
Route::Post('/loginprocess',[registerloginController::class,'loginprocess'])->name('loginprocess');
Route::get('/logout',[registerloginController::class,'logout'])->name('logout');

//:::::::::::::::::::: Admin Routes :::::::::::::::::::::::::::::::::::::://

Route::group(['middleware' =>  'admin'], function () {
Route::get('/admin-dashboard' ,[AdminDashboardController::class,'adminDashboard']);

//::::::::::::::::::::::::::Category Routes::::::::::::::::::::::::::::::::://
Route::get('/category-list',[Categorycontroller::class,'categoryList']);
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::::::::::Designer request::::::::::::::::::::::::::::::::://
Route::get('/designer-list',[adminDesignerController::class,'designerlist']);
Route::get('/approved-designer',[adminDesignerController::class,'approveddesigner']);
Route::get('/disapproved-designer',[adminDesignerController::class,'disapproveddesigner']);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::::::::::product request::::::::::::::::::::::::::::::::://
Route::get('/product-request',[AdminProductController::class,'productrequest']);
Route::get('/approve/{id}',[AdminProductController::class,'approveProduct'])->name('approve');
Route::get('/disapprove/{id}',[AdminProductController::class,'disapproveProduct'])->name('disapprove');
Route::get('/product-approved',[AdminProductController::class,'productapproved']);
Route::get('/product-disapproved',[AdminProductController::class,'productdisapproved']);
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
});
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//::::::::::::::::::::::Designer Routes::::::::::::::::::::::::::::::::::::::::::://

Route::group(['middleware' =>  'designer'], function () {
Route::get('/designer-dashboard',[DesignerDashboardController::class,'designerDashboard']);
Route::get('/add-category',[Categorycontroller::class,'categoryPage']);
Route::post('/add-category-process',[Categorycontroller::class,'addcatProcess']);
Route::get('/add-product',[ProductController::class,'productPage']);
Route::post('/add-product-process',[ProductController::class,'addproductProcess']);
});
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

//:::::::::::::::::::::: User Routes::::::::::::::::::::::::::::::::::::::::::://
// Route::group(['middleware' =>  'Auth'], function () {

Route::get('/',[userDashboardController::class,'index']);
// });
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://


Route::get('/send-mail',[MailController::class,'sendmail']);


