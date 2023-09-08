<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wishliist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function liked_by()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
    }

    public function scopeFilter($query, array $filter)
    {
        if ($filter['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }
}
