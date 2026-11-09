<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        return view('admin.transactions', [
            'sales' => Sale::withCount('items')->latest()->paginate(30),
            'products' => Product::where('is_active', true)->orderBy('name')->get(['id', 'name', 'brand', 'stock_quantity', 'price_lkr']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        $sale = DB::transaction(function () use ($request, $data) {
            $sale = Sale::create(['reference' => 'FC-'.now()->format('ymd').'-'.Str::upper(Str::random(6)), 'user_id' => $request->user()->id, 'total_lkr' => 0, 'status' => 'completed']);
            $total = 0;

            foreach ($data['items'] as $item) {
                $product = Product::query()->lockForUpdate()->findOrFail($item['product_id']);
                abort_unless($product->is_active, 422, "{$product->name} is inactive.");
                abort_if($product->stock_quantity < $item['quantity'], 422, "Not enough stock for {$product->name}.");

                $lineTotal = $product->price_lkr * $item['quantity'];
                $total += $lineTotal;
                $sale->items()->create(['product_id' => $product->id, 'product_name' => $product->name, 'quantity' => $item['quantity'], 'unit_price_lkr' => $product->price_lkr, 'cost_price_lkr' => $product->cost_price]);
                $product->decrement('stock_quantity', $item['quantity']);
                $product->stockMovements()->create(['user_id' => $request->user()->id, 'quantity_change' => -$item['quantity'], 'stock_after' => $product->stock_quantity, 'reason' => 'sale']);
            }

            $sale->update(['total_lkr' => $total]);

            return $sale;
        });

        return back()->with('success', "Transaction {$sale->reference} recorded.");
    }
}
