<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\Shoopingcart;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('shoopingcart',Shoopingcart::class)->name('shooping-cart');
Route::get('payment-cancel',[PaypalController::class,'cancel'])->name('payment.cancel');
Route::get('payment-success',[PaypalController::class,'success'])->name('payment.success');


Route::group(['middleware'=>'auth'],function(){
    Route::post('/store-token', [NotificationController::class, 'updateDeviceToken'])->name('store.token');
    Route::post('/send-web-notification', [NotificationController::class, 'sendNotification'])->name('send.web-notification');
});

Route::get('map',[TestController::class,'index'])->name('map');

