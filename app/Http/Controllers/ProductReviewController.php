<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_if($request->user()->isAdmin(), 403, 'Product reviews are for customer accounts.');
        abort_unless($product->is_active && $product->category->is_active, 404);

        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'body' => ['nullable', 'string', 'max:1200'],
        ]);

        ProductReview::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => $request->user()->id],
            ['rating' => $data['rating'], 'body' => $data['body'] ?? null],
        );

        return redirect()->to(route('home', ['category' => $product->category->code]).'#product-'.$product->id)
            ->with('success', 'Your review has been saved.');
    }

    public function destroy(Request $request, ProductReview $review): RedirectResponse
    {
        abort_unless($review->user_id === $request->user()->id && ! $request->user()->isAdmin(), 403);
        $product = $review->product;
        $review->delete();

        return redirect()->to(route('home', ['category' => $product->category->code]).'#product-'.$product->id)
            ->with('success', 'Your review has been removed.');
    }
}
