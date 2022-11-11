<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * DONE
     */
    public function categories()
    {
        return $this->belongsToMany(ItemCategory::class, 'item_category');
    }

    /**
     * DONE
     */
    public function types()
    {
        return $this->belongsToMany(ItemType::class, 'item_type');
    }

    /**
     * DONE
     */
    public function subtypes()
    {
        return $this->belongsToMany(ItemSubtype::class, 'item_subtype');
    }

    /**
     * DONE
     */
    public function models()
    {
        return $this->belongsToMany(ItemModel::class, 'item_model');
    }

    /**
     * DONE
     */
    public function applications()
    {
        return $this->belongsToMany(ItemApplication::class, 'item_application');
    }

    /**
     * DONE
     */
    public function guardians()
    {
        return $this->belongsToMany(ItemGuardian::class, 'item_guardian');
    }

    /**
     * DONE
     */
    public function handlers()
    {
        return $this->belongsToMany(ItemHandler::class, 'item_handler');
    }

    /**
     * DONE 
     */
    public function departments()
    {
        return $this->belongsToMany(ItemDepartment::class, 'item_department');
    }

    /**
     * MM
     */
    public function locations()
    {
        return $this->belongsToMany(ItemLocation::class, 'item_location');
    }

    /**
     * MM
     */
    public function processes()
    {
        return $this->belongsToMany(ItemProcess::class, 'item_process');
    }

    /**
     * MM
     */
    public function statuses()
    {
        return $this->belongsToMany(ItemStatus::class, 'item_status');
    }

    /**
     * DONE
     */
    public function providers()
    {
        return $this->belongsToMany(ItemProvider::class, 'item_provider');
    }

    /**
     * DONE
     */
    public function serial()
    {
        return $this->hasOne(ItemSerial::class);
    }
}
