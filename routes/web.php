<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Admin controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Manager controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ManagerController;
/*
|--------------------------------------------------------------------------
| Sales controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SalespersonController;

/*
|--------------------------------------------------------------------------
| Frontend controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CartController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
|
*/

// 🌐 Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', fn () => redirect()->route('home'));
// Route::get('/category', [HomeController::class, 'show'])->name('categories.show');
// Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
// Route::get('/details', [ShopController::class, 'shopDetails'])->name('shopDetails');
// Route::get('/shop/{category}', [ShopController::class, 'category'])-> name('shop.category');
// Route::get('/shop/{category}/{subcategory}', [ShopController::class, 'subcategory'])-> name('shop.subcategory');
// Route::get('/shop/{category}/{subcategory}/{product}', [ShopController::class, 'product '])-> name('shop.product');
// Route::get('/product/{product}', [ShopController::class, 'product'])-> name('product.show');

Route::get('/category', [HomeController::class, 'show'])->name('categories.show');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop/{category}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/shop/{category}/{subcategory}', [ShopController::class, 'subcategory'])->name('shop.subcategory');
Route::get('/product/{product}', [ShopController::class, 'product'])->name('product.show');

// Review routes
// Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Question routes
// Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

// Route::get('/details', function () {
//     return view('front.home.details');
// });

// 👤 Guest (Unauthenticated Users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // You can also add register, forgot-password, etc.
    // Route::get('/register', ...);
    // Route::get('/forgot-password', ...);
});

// 🔒 Authenticated Users
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
});


/*
|--------------------------------------------------------------------------
| Admin, Manager, Sale Routes
|--------------------------------------------------------------------------
|
|
*/

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Admin Auth Routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');



// Admin Middleware Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('categories', MainCategoryController::class);
        Route::resource('sub-categories', SubCategoryController::class);
        // Add this route - note the admin prefix is already applied
        Route::get('categories/{mainCategory}/sub-categories', [SubCategoryController::class, 'getByMainCategory'])
            ->name('categories.sub-categories');
        // Slug generation route
        Route::post('products/generate-slug', [ProductController::class, 'generateSlug'])
            ->name('products.generate-slug');
        Route::resource('products', ProductController::class);
        // Add these two new routes for toggle buttons
        Route::put('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
            ->name('products.toggle-status');

        Route::put('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])
            ->name('products.toggle-featured');
    });

    Route::prefix('manager')->name('manager.')->middleware('role:manager')->group(function () {
        // Route::get('/dashboard', [ManagerController::class, 'index'])->name('dashboard');

    });

    Route::prefix('sales')->name('sales.')->middleware('role:salesperson')->group(function () {
        // Route::get('/dashboard', [SalesController::class, 'index'])->name('dashboard');

    });

    Route::get('/home', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        } elseif ($user->hasRole('salesperson')) {
            return redirect()->route('sales.dashboard');
        }

        abort(403, 'Unauthorized access.');
    })->name('home');

});


require __DIR__.'/auth.php';
