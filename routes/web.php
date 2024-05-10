<?php

use App\Http\Controllers\DebugController;
use App\Livewire\CareerDetail;
use App\Livewire\Contact;
use App\Livewire\DownloadCenter;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\News;
use App\Livewire\NewsDetail;
use App\Livewire\Otp;
use App\Livewire\Product;
use App\Livewire\ProductDetail;
use App\Livewire\Career;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware grou  p. Make something great!
|
*/

Route::get('/', [DebugController::class, 'underconstruction']);
Route::get('/privacy-policy', function(){
    return view('privacy-policy');
})->name('privacy-policy');
Route::get('/terms-conditions', function(){
    return view('terms-conditions');
})->name('terms-conditions');
Route::get('/', Home::class)->name('home');
Route::get('/product', Product::class)->name('product');
Route::get('/product/{slug}', ProductDetail::class)->name('product-detail');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/career', Career::class)->name('career');
Route::get('/career/{title}', CareerDetail::class)->name('career_detail');
// Route::get('/download-center', DownloadCenter::class)->name('download-center');
Route::get('/news', News::class)->name('news');
Route::get('/news/{slug}', NewsDetail::class)->name('news-detail');

Route::prefix('maj')->group(function() {
    Route::get('/login', Login::class)->name('login');
    Route::get('/{email}/otp', Otp::class)->name('otp');
});

Route::get('/debug/tesmail', [DebugController::class, 'tesmail']);
Route::get('/debug/tesmaillaravel', [DebugController::class, 'tesmaillaravel']);

/**
 * Google Auth
 */
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth-google-redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
 
    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'password' => Hash::make('123'),
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);
    Auth::login($user);

    if(Auth::check()){
        Auth::logout();
        $otp_code = mt_rand(100000,999999);
		$exp_otp_code = date('Y-m-d H:i:s', strtotime('+10 minutes')); //OTP 10 Minutes

        $updateUser = User::where('email', $user->email)->first();
        $updateUser->otp = $otp_code;
        $updateUser->otp_expired = $exp_otp_code;
        $updateUser->update();

        // try {
        //     Mail::to($user->email)->send(new OtpMail($otp_code, $user->name));

        //     return redirect()->route('otp', ['email' => $user->email]);
        // } catch (\Throwable $th) {
            
        // }
        try {
            $ip = "36.91.11.21";
            // $ip = "10.30.20.120";
            $url = "http://$ip/~wipapps/notifikasi_pembayaran_surat/frontend/web/index.php?r=otp/otp";

            $data = array(
                'email' => $user->email,
                'username' => $user->name,
                'otp' => $otp_code,
                'key' => 'madajaya',
                'app_name' => 'New Armada'
            );

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if(curl_errno($ch)){
                return redirect()->route('login')->with('failed', 'Login failed, email server error. Please contact IT Division. Err Code [02]');
            }

            curl_close($ch);
            $res = json_decode($response);
            if($res->status == 200){
                return redirect()->route('otp', ['email' => $user->email]);
            }else {
                return redirect()->route('login')->with('failed', 'Login failed, email server error. Please contact IT Division . Err Code [03]');
            }
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('failed', 'Login failed, email server error. Please contact IT Division . Err Code [01]');
        }
    }else {
        return redirect()->route('login')->with('failed', 'Login failed, pleas try again');
    }
})->name('auth-google-callback');