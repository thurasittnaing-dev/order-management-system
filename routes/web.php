<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\KitchenModuleController;
use App\Http\Controllers\OrderModuleController;
use App\Http\Controllers\OrderTablesController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Models\OrderTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

    //Recipe Table Routes
    Route::resource('recipe', RecipeController::class)->except('show');
    Route::get('addpromotion/{recipe}', [RecipeController::class, 'addPromotion'])->name('recipe.addpromotion');
    Route::post('storepromotion/{recipe}', [RecipeController::class, 'storePromotion'])->name('recipe.storepromotion');
});



// Order Group
Route::group(['middleware' => 'auth', 'prefix' => 'order-management'], function () {
    // Rooms View
    Route::get('/rooms', [OrderModuleController::class, 'rooms'])->name('rooms');

    // Tables View
    Route::get('rooms/{room}/tables', [OrderModuleController::class, 'tables'])->name('tables');

    // Recipes
    Route::get('recipes/{table}/{order?}', [OrderModuleController::class, 'recipes'])->name('recipes');

    // Make Order
    Route::get('make_order/{table}/{order?}', [OrderModuleController::class, 'makeOrder'])->name('makeOrder');

    //Store Order
    Route::post('/store_order/{table}/{order?}', [OrderModuleController::class, 'store'])->name('storeOrder');

    //Checkout
    Route::post('/checkout/{order?}', [OrderModuleController::class, 'checkout'])->name('checkout');

    //Order History
    Route::get('/order_history', [OrderModuleController::class, 'orderHistory'])->name('orderHistory');

    //Inuse Table
    Route::get('/inuse_table', [OrderModuleController::class, 'inuseTable'])->name('inuseTable');

});


// Kitchen Group
Route::group(['middleware' => 'auth', 'prefix' => 'kitchen'], function () {
    // Orders
    Route::get('/orders', [KitchenModuleController::class, 'orders'])->name('orders');
    //Status
    Route::post('/order/status', [KitchenModuleController::class, 'updateStatus'])->name('order.status');
    //History
    Route::get('/history', [KitchenModuleController::class, 'history'])->name('history');
});


