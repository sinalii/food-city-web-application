<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'brand', 'pack_size', 'price_lkr', 'dietary_tags', 'image_path', 'is_deal', 'description', 'cost_price', 'sku', 'barcode', 'unit', 'is_active', 'stock_quantity', 'minimum_stock', 'expiry_date'];

    protected function casts(): array
    {
        return ['price_lkr' => 'integer', 'cost_price' => 'integer', 'stock_quantity' => 'integer', 'minimum_stock' => 'integer', 'is_active' => 'boolean', 'is_deal' => 'boolean', 'dietary_tags' => 'array', 'expiry_date' => 'date'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
}
