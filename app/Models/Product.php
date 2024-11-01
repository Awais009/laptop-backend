<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded;

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function image(){
        return $this->hasOne(ProductImage::class);
    }

    public function navigation(){
        return $this->belongsTo(Navigation::class);
    }
    public function navigation_item(){
        return $this->belongsTo(NavigationItem::class);
    }

}
