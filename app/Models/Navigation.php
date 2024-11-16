<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use HasFactory,SoftDeletes;

       public function products(){
           return $this->hasMany(Product::class);
       }
    public function items(){
        return $this->hasMany(NavigationItem::class);
    }
}
