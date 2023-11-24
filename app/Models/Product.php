<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Brand;
use App\Models\OrderDetail;

class Product extends Model
{
    use HasFactory;
    public $table = 'tbl_product';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'price',
        'desc',
        'content',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

}
