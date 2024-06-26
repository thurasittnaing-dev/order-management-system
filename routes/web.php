<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTablesController;
use App\Models\OrderTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderModuleController;

// Redirect Route
Route::get('/', fn () => redirect()->route('main-dashboard'));

// Auth Routes
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);


Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('dashboard', function () {
        return view('backend.dashboard.main-dashboard');
    })->name('main-dashboard');

    // Category Routes
    Route::resource('category', CategoryController::class)->except('show');

    // Room Routes
    Route::resource('room', RoomController::class);

    // User Routes
    Route::resource('user', UserController::class)->except('show');;
    Route::get('changepassword', [UserController::class, 'changePassword'])->name('user.changepassword');
    Route::post('changepassword', [UserController::class, 'storePassword'])->name('user.storepassword');
    Route::post('changeuserpassword/{user}', [UserController::class, 'storeUserpassword'])->name('user.storeuserpassword');

    // Order Table Routes
    Route::resource('order_tables', OrderTablesController::class);

    //Ingredient Table Routes
    Route::resource('ingredient', IngredientController::class);
});



// Order Group
Route::group(['middleware' => 'auth', 'prefix' => 'order-management'], function () {
    // Rooms View
    Route::get('/rooms', [OrderModuleController::class, 'rooms'])->name('rooms');

    // Tables View
    Route::get('rooms/{room}/tables', [OrderModuleController::class, 'tables'])->name('tables');

    // Recipes
    Route::get('recipes/{table}/{invoice?}', [OrderModuleController::class, 'recipes'])->name('recipes');

    // Make Order
    Route::get('make_order/{table}/{invoice?}', [OrderModuleController::class, 'makeOrder'])->name('makeOrder');
});


// Kitchen Group
Route::group(['middleware' => 'auth', 'prefix' => 'kitchen'], function () {
    // Orders
    Route::get('/orders', [OrderModuleController::class, 'orders'])->name('orders');
});
