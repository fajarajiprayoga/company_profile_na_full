<?php

use App\Http\Controllers\DebugController;
use App\Livewire\Contact;
use App\Livewire\DownloadCenter;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Otp;
use App\Livewire\Product;
use App\Livewire\ProductDetail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [DebugController::class, 'underconstruction']);
Route::get('/construction', Home::class)->name('home');
Route::get('/construction/product', Product::class)->name('product');
Route::get('/construction/product/{slug}', ProductDetail::class)->name('product-detail');
Route::get('/construction/contact', Contact::class)->name('contact');
// Route::get('/download-center', DownloadCenter::class)->name('download-center');

Route::prefix('maj')->group(function() {
    Route::get('/login', Login::class)->name('login');
    Route::get('/{email}/otp', Otp::class)->name('otp');
});

Route::get('/debug/tesmail', [DebugController::class, 'tesmail']);
Route::get('/debug/tesmaillaravel', [DebugController::class, 'tesmaillaravel']);