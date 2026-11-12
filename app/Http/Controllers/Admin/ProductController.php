<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()->with('category')->when($request->filled('q'), fn ($query) => $query->where(fn ($s) => $s->where('name', 'like', '%'.$request->q.'%')->orWhere('brand', 'like', '%'.$request->q.'%')->orWhere('sku', 'like', '%'.$request->q.'%')->orWhere('barcode', 'like', '%'.$request->q.'%')))->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->integer('category_id')))->when($request->filled('stock'), fn ($q) => $request->stock === 'out' ? $q->where('stock_quantity', 0) : ($request->stock === 'low' ? $q->whereColumn('stock_quantity', '<=', 'minimum_stock') : $q))->latest()->paginate(20)->withQueryString();

        return view('admin.products.index', ['products' => $products, 'categories' => Category::orderBy('name')->get()]);
    }

    public function create(): View
    {
        return view('admin.products.form', ['product' => new Product(), 'categories' => Category::orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::create($this->validated($request));
        $this->saveImage($request, $product);
        if ($product->stock_quantity > 0) {
            $product->stockMovements()->create(['user_id' => $request->user()->id, 'quantity_change' => $product->stock_quantity, 'stock_after' => $product->stock_quantity, 'reason' => 'opening_stock']);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product added.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', ['product' => $product, 'categories' => Category::orderBy('name')->get()]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $before = $product->stock_quantity;
        $product->update($this->validated($request));
        $this->saveImage($request, $product);
        if ($before !== $product->stock_quantity) {
            $product->stockMovements()->create(['user_id' => $request->user()->id, 'quantity_change' => $product->stock_quantity - $before, 'stock_after' => $product->stock_quantity, 'reason' => 'manual_edit']);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        abort_if($product->saleItems()->exists() || $product->stockMovements()->exists(), 422, 'This product has transaction or stock history and cannot be deleted.');
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'], 'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'], 'brand' => ['required', 'string', 'max:255'],
            'pack_size' => ['required', 'string', 'max:100'], 'unit' => ['required', 'string', 'max:50'],
            'price_lkr' => ['required', 'integer', 'min:0'], 'cost_price' => ['required', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:100', 'unique:products,sku,'.$request->route('product')?->id],
            'barcode' => ['nullable', 'string', 'max:100', 'unique:products,barcode,'.$request->route('product')?->id],
            'stock_quantity' => ['required', 'integer', 'min:0'], 'minimum_stock' => ['required', 'integer', 'min:0'],
            'expiry_date' => ['nullable', 'date'], 'dietary_tags' => ['nullable', 'array'], 'dietary_tags.*' => ['string', 'max:60'],
            'image' => ['nullable', 'image', 'max:5120'], 'is_active' => ['nullable', 'boolean'], 'is_deal' => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['is_deal'] = $request->boolean('is_deal');
        $data['dietary_tags'] = $data['dietary_tags'] ?? [];
        unset($data['image']);

        return $data;
    }

    private function saveImage(Request $request, Product $product): void
    {
        if ($request->hasFile('image')) {
            if ($product->image_path) Storage::disk('public')->delete($product->image_path);
            $product->update(['image_path' => $request->file('image')->store('products', 'public')]);
        }
    }
}
