<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemHistory extends Model
{
    protected $fillable = [
        'item_id', 'type', 'quantity', 'source', 'note', 'date'
    ];

    public function item(): BelongsTo {
        return $this->belongsTo(Item::class);
    }
}