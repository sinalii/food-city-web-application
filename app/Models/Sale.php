<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = ['reference', 'user_id', 'total_lkr', 'status'];

    protected function casts(): array
    {
        return ['total_lkr' => 'integer'];
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
