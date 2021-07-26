<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
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

Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('sociallogin/{provider}', [App\Http\Controllers\SocialController::class, 'SocialSignup']);
Route::post('auth/{provider}', 'OutController@index')->where('vue', '.*');
Route::post('auth/{provider}/callback', 'OutController@index')->where('vue', '.*');

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('products', ProductController::class);
// });
