<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function media()
    {
        return $this->hasMany(Media::class,'product_id','id');
    }

    protected $fillable = [
        'is_approved',
        'is_disapproved',
      ];

}
