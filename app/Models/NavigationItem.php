<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    use HasFactory;

    public function products()
    {
        $this->hasMany(Product::class);
    }

    public function navigation()
    {
        $this->belongsTo(NavigationItem::class);
    }
}
