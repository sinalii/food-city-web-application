<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $categories = Category::query()->withCount('products')->orderBy('sort_order')->get();
    $products = Product::query()
        ->with('category:id,name,code')
        ->when($request->filled('category'), fn ($query) => $query->whereHas('category', fn ($category) => $category->where('code', $request->string('category'))))
        ->when($request->filled('q'), fn ($query) => $query->where(fn ($search) => $search
            ->where('name', 'like', '%'.$request->string('q').'%')
            ->orWhere('brand', 'like', '%'.$request->string('q').'%')))
        ->orderBy('name')
        ->paginate(12)
        ->withQueryString();

    $deals = Product::query()->with('category:id,name')->where('is_deal', true)->latest()->take(3)->get();

    return view('welcome', compact('categories', 'products', 'deals'));
})->name('home');
