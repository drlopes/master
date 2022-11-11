<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemApplication extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_application');
    }
}
