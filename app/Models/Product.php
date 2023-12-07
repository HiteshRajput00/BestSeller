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
        return $this->hasMany(Media::class, 'product_id', 'id');
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

}
