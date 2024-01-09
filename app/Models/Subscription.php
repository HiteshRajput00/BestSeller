<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
     'payment_status',
     'billing_cycle',
     'start_date',
     'end_date',
     'auto_renewal',
     'amount',
     'is_active'

    ];
}
