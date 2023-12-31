<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\City;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'tbl_quanhuyen';
    public $timestamps = false;

    protected $fillable = [
        'maqh',
        'name',
        'type',
        'maqh',
    ];

    public function city(){
        return $this->belongsTo(City::class, 'matp', 'id');
    }

    public function communes()
    {
        return $this->hasMany(Commune::class);
    }


}
