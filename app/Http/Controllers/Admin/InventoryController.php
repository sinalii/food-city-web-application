<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.inventory', [
            'products' => Product::query()->with('category')->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->q.'%')->orWhere('sku', 'like', '%'.$request->q.'%'))->orderBy('stock_quantity')->paginate(25)->withQueryString(),
            'movements' => StockMovement::with(['product', 'user'])->latest()->limit(30)->get(),
        ]);
    }

    public function adjust(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate(['quantity_change' => ['required', 'integer', 'not_in:0'], 'reason' => ['required', 'in:received,damaged,expired,correction'], 'expiry_date' => ['nullable', 'date'], 'notes' => ['nullable', 'string', 'max:1000']]);
        if (($data['reason'] === 'received' && (int) $data['quantity_change'] < 0) || (in_array($data['reason'], ['damaged', 'expired'], true) && (int) $data['quantity_change'] > 0)) {
            return back()->withErrors(['quantity_change' => 'Received stock must be positive; damaged or expired stock must be negative.'])->withInput();
        }

        DB::transaction(function () use ($request, $product, $data) {
            $lockedProduct = Product::query()->lockForUpdate()->findOrFail($product->id);
            $after = $lockedProduct->stock_quantity + (int) $data['quantity_change'];
            abort_if($after < 0, 422, 'Stock cannot be reduced below zero.');
            $lockedProduct->update(['stock_quantity' => $after, 'expiry_date' => $data['expiry_date'] ?? $lockedProduct->expiry_date]);
            $lockedProduct->stockMovements()->create(['user_id' => $request->user()->id, 'quantity_change' => $data['quantity_change'], 'stock_after' => $after, 'reason' => $data['reason'], 'expiry_date' => $data['expiry_date'] ?? null, 'notes' => $data['notes'] ?? null]);
        });

        return back()->with('success', 'Stock adjustment recorded.');
    }
}
