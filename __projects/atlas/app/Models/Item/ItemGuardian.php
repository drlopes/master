<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGuardian extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_guardian');
    }
}
