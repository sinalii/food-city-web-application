<?php

use App\Models\Product;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:8,1')->name('login.store');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ProductReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/wishlist', function (Request $request) {
        return view('wishlist', ['products' => $request->user()->wishlist()->orderBy('name')->get()]);
    })->name('wishlist.index');
    Route::post('/wishlist/{product}', function (Request $request, Product $product) {
        $request->user()->wishlist()->syncWithoutDetaching([$product->id]);

        return back()->with('success', 'Added to your wishlist.');
    })->name('wishlist.add');
    Route::delete('/wishlist/{product}', function (Request $request, Product $product) {
        $request->user()->wishlist()->detach($product->id);

        return back()->with('success', 'Removed from your wishlist.');
    })->name('wishlist.remove');
    Route::delete('/wishlist', function (Request $request) {
        $request->user()->wishlist()->detach();

        return back()->with('success', 'Your wishlist is clear.');
    })->name('wishlist.clear');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/inventory/{product}/adjust', [InventoryController::class, 'adjust'])->name('inventory.adjust');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
});

Route::get('/', function (Request $request) {
    $productQuery = Product::query()->where('is_active', true)
        ->with(['reviews.user:id,name'])
        ->withAvg('reviews', 'rating')
        ->withCount('reviews')
        ->when($request->filled('q'), fn ($query) => $query->where(fn ($search) => $search
            ->where('name', 'like', '%'.$request->string('q').'%')
            ->orWhere('brand', 'like', '%'.$request->string('q').'%')))
        ->when($request->filled('brand'), fn ($query) => $query->where('brand', $request->string('brand')))
        ->when($request->filled('min_price'), fn ($query) => $query->where('price_lkr', '>=', $request->integer('min_price')))
        ->when($request->filled('max_price'), fn ($query) => $query->where('price_lkr', '<=', $request->integer('max_price')))
        ->when($request->filled('dietary'), fn ($query) => $query->whereJsonContains('dietary_tags', $request->string('dietary')));
    $products = $productQuery->orderBy('name')->get();
    $brands = Product::query()->where('is_active', true)->distinct()->orderBy('brand')->pluck('brand');
    $dietaryOptions = Product::query()->whereNotNull('dietary_tags')->pluck('dietary_tags')->flatten()->unique()->sort()->values();

    $deals = Product::query()->where('is_active', true)->where('is_deal', true)->latest()->take(3)->get();

    return view('welcome', compact('products', 'deals', 'brands', 'dietaryOptions'));
})->name('home');

