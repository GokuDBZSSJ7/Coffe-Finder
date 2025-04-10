<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id', 'title', 'description', 'event_date', 'image_url'
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
