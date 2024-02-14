<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'category_id',
    ];

    public function historyModule()
    {
        return $this->hasMany(HistoryModule::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
