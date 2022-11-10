<?php

namespace App\Models;

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
     *
     */
    public function applications()
    {
        return $this->belongsToMany(ItemApplication::class, 'item_application');
    }

    /**
     *
     */
    public function guardians()
    {
        return $this->belongsToMany(ItemGuardian::class, 'item_guardian');
    }

    /**
     *
     */
    public function handlers()
    {
        return $this->belongsToMany(ItemHandler::class, 'item_handler');
    }

    /**
     *
     */
    public function departments()
    {
        return $this->belongsToMany(ItemDepartment::class, 'item_department');
    }

    /**
     *
     */
    public function locations()
    {
        return $this->belongsToMany(ItemLocation::class, 'item_location');
    }

    /**
     *
     */
    public function processes()
    {
        return $this->belongsToMany(ItemProcess::class, 'item_process');
    }

    /**
     *
     */
    public function statuses()
    {
        return $this->belongsToMany(ItemStatus::class, 'item_status');
    }

    /**
     *
     */
    public function providers()
    {
        return $this->belongsToMany(ItemProvider::class, 'item_provider');
    }
}
