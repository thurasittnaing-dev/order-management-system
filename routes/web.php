<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTablesController;
use App\Models\OrderTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Storage;

// Redirect Route
Route::get('/', fn () => redirect()->route('main-dashboard'));

// Auth Routes
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/test', function () {
    $data = public_path('images/default_categories/chinese_drink.png');
    if (file_exists($data)) {

        $fileContents = file_get_contents($data);
        $destinationPath = 'public/categories/' . time() . '.png';
        Storage::put($destinationPath, $fileContents);
    }
});



Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('dashboard', function () {
        return view('backend.dashboard.main-dashboard');
    })->name('main-dashboard');

    // Category Routes
    Route::resource('category', CategoryController::class)->except('show');

    // User Routes
    Route::resource('user', UserController::class)->except('show');;
    Route::get('changepassword', [UserController::class, 'changePassword'])->name('user.changepassword');
    Route::post('changepassword', [UserController::class, 'storePassword'])->name('user.storepassword');

    // Order Table Routes
    Route::resource('order_tables', OrderTablesController::class);

    //Ingredient Table Routes
    Route::resource('ingredient',IngredientController::class);

});
