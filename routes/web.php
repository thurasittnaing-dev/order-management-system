<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTablesController;
use App\Models\OrderTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


use App\Http\Controllers\CategoryController;


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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', function () {
        return view('backend.dashboard.main-dashboard');
    });


    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('order_tables',OrderTablesController::class);

});


