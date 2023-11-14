<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'tbl_order';

    protected $fillable = [
        'total',
        'status',
        'customer_id',
        'shipping_id',
        'payment_id'
    ];

}
