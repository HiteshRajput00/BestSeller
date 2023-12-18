<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;
    public function media()
    {
        return $this->hasOne(Media::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'price',
        'stock',
        'is_approved',
        'is_disapproved',
        'status',
    ];

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class);
    }
 
}
