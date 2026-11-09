<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'brand', 'pack_size', 'price_lkr', 'image_path', 'is_deal'];

    protected function casts(): array
    {
        return ['price_lkr' => 'integer', 'is_deal' => 'boolean'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
