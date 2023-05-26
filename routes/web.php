<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserAuthController;
use App\Http\controllers\AdminAuthController;
use App\Http\controllers\BlogController;

use Illuminate\Support\Facades\Redis;



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

Route::get('/', function () {
    return view('user.home');
})->name('user.home')->middleware('auth:web');
Route::get('/login',[UserAuthController::class,'login'])->name('user.login');
Route::post('/login',[UserAuthController::class,'handlelogin'])->name('user.handlelogin');
Route::get('/logout',[UserAuthController::class,'logout'])->name('user.logout');

Route::get('/admin',[AdminAuthController::class,'index'])->name('admin.home')->middleware('auth:webadmin');
Route::get('/admin/login',[AdminAuthController::class,'login'])->name('admin.login');
Route::get('/admin/logout',[AdminAuthController::class,'logout'])->name('admin.logout');

Route::post('admin/login',[AdminAuthController::class,'handlelogin'])->name('admin.handlelogin');

Route::get('addReview',[UserAuthController::class,'addReview']);
Route::post('addReviewPost',[UserAuthController::class,'addReviewPost'])->name('addReviewPost');

Route::get('AdminManageReview',[AdminAuthController::class,'AdminManageReview'])->name('AdminManageReview');
Route::any('userApprove/{id}',[AdminAuthController::class,'userApprove']);
Route::any('userReject/{id}',[AdminAuthController::class,'userReject']);

Route::get('myreview',[UserAuthController::class,'myreview']);
Route::get('items/{id}',[UserAuthController::class,'destroy']);
Route::get('addProduct',[AdminAuthController::class,'addProduct'])->name('admin.addProduct');
Route::post('productpost',[AdminAuthController::class,'productpost']);

Route::get('/blogs/{id}', [BlogController::class, 'index']);

Route::any('event',[BlogController::class, 'event']);

Route::get('sort',function(){
    $data = array('name'=>"Virat Gandhi");
   
    Mail::send('eventMail', $data, function($message) {
       $message->to('pankaj.singh910025@gmail.com', 'Tutorials Point')->subject
          ('Laravel Basic Testing Mail');
       $message->from('pankaj.singh910025@gmail.com','Virat Gandhi');
    });
    echo "Basic Email Sent";
    
});
Route::get('/bl/{id}', [BlogController::class, 'bl']);