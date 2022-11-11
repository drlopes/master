<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSerial extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
