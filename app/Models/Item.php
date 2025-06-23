<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'name', 'stock', 'purchase_price', 'selling_price', 'source'
    ];

    public function histories(): HasMany {
        return $this->hasMany(ItemHistory::class);
    }
}