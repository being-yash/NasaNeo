<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasaNeoController;

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
    $today = Carbon\Carbon::now()->isoFormat('YYYY-MM-DD');
    return view('welcome',compact('today'));
});
Route::post('/getNeos', [NasaNeoController::class, 'getNeos'])->name('getNeos');
Route::fallback(function () {
    return abort(404);
});
