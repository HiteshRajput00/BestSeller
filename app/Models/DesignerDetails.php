<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'web_url',
        'street',
        'city',
        'state',
        'zip',
        'country',
    ];

}
