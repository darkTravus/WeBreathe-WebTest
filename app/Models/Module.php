<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'entity_id',
        'description',
        'actual_status',
    ];

    public function historyModule()
    {
        return $this->hasMany(HistoryModule::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
