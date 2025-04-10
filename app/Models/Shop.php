<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'description', 'address', 'city',
        'latitude', 'longitude', 'opening_hours', 'image_url'
    ];

    protected $casts = [
        'opening_hours' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
