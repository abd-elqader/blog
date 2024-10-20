<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Auth\AdminAuth\AdminAuthenticatedSessionController;

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
Route::middleware('guest')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AdminAuthenticatedSessionController::class, 'store'])
        ->name('store');
});

Route::middleware(['auth.admin'])->group(function () {
    // Routes accessible to administrators
    Route::view('/dashboard', 'dashboard.index');
});
// ADMIN DASHBOARD
Route::middleware('guest')->group(function () {
    Route::view('/dashboard/admin/login', 'dashboard.auth.login');
});


// THEME ROUTES
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category/{id}', 'category')->name('category');
    Route::get('/contact', 'contact')->name('contact');
});

// SUBSCRIBER STORE ROUTE
Route::post('/subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');

// CONTACT STORE ROUTE
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// BLOG ROUTES
Route::get('/my-blogs', [BlogController::class, 'myBlogs'])->name('blogs.my-blogs');
Route::resource('blogs', BlogController::class)->except('index');

// COMMENT ROUTE
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');

require __DIR__ . '/auth.php';
