<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'temperature_value',
        'total_passenger_count',
        'distance_traveled',
        'boarding_passenger_count',
        'alighting_passenger_count',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
