<?php

use App\Http\Controllers\auth\AuthenticationController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\ProductController as CustomerProductController;
use App\Http\Controllers\customer\TransactionController;
use App\Http\Controllers\merchant\OrderController;
use App\Http\Controllers\merchant\ProfileController;
use App\Http\Controllers\merchant\ProductController;
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

Route::get('/', function () {
    return view('index');
})->name('pages.home');

Route::get('/login', [AuthenticationController::class, 'loin'])->name('pages.auth.login');
Route::post('/do_login', [AuthenticationController::class, 'do_login'])->name('pages.auth.do_login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('pages.auth.logout');

Route::get('/register', [RegisterController::class, 'register'])->name('pages.auth.register');
Route::post('/do_register', [RegisterController::class, 'do_register'])->name('pages.auth.do_register');

Route::prefix('/merchant')
    ->middleware(['auth', 'role'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('pages.merchant.dashboard.index');
        })->name('pages.merchant.dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('pages.merchant.profile');
        Route::post('/update_profile', [ProfileController::class, 'update'])->name('pages.merchant.update_profile');

        Route::prefix('/products')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('pages.merchant.products');
            Route::get('/create', [ProductController::class, 'create'])->name('pages.merchant.products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('pages.merchant.products.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('pages.merchant.products.edit');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('pages.merchant.products.edit');
            Route::put('/edit/{id}', [ProductController::class, 'update'])->name('pages.merchant.products.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('pages.merchant.products.destroy');
        });

        Route::prefix('/orders')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('pages.merchant.orders');
            Route::post('/{id}', [OrderController::class, 'verify'])->name('pages.merchant.orders.verify');
        });
    });

Route::prefix('/customer')
    ->middleware(['auth', 'role'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('pages.customer.dashboard.index');
        })->name('pages.customer.dashboard');

        Route::prefix('/products')->group(function () {
            Route::get('', [CustomerProductController::class, 'index'])->name('pages.customer.products');
            Route::get('/{id}', [CustomerProductController::class, 'show'])->name('pages.customer.products.show');
            Route::post('/addToCart/{id}', [CustomerProductController::class, 'addToCart'])->name('pages.customer.products.addToCart');
        });

        Route::prefix('/carts')->group(function () {
            Route::get('', [CartController::class, 'index'])->name('pages.customer.carts');
            Route::get('/{id}', [CartController::class, 'destroy'])->name('pages.customer.carts.destroy');
        });

        Route::prefix('/transactions')->group(function () {
            Route::get('', [TransactionController::class, 'index'])->name('pages.customer.transactions');
            Route::post('', [TransactionController::class, 'store'])->name('pages.customer.transactions.store');
        });
    });
