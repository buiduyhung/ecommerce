<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'tbl_brand_product';

    protected $fillable = [
        'title',
        'slug',
        'desc',
        'status',
        'keywords',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
