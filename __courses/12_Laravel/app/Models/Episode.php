<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['number'];
    protected $casts = ['watched' => 'boolean'];

    public function season()
    {
        $this->belongsTo(Season::class);
    }
}
