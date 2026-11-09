<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['code', 'name', 'image_path', 'sort_order', 'description', 'is_active'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
