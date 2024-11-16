<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NavigationItem extends Model
{
    use HasFactory,SoftDeletes;

    public function products()
    {
        $this->hasMany(Product::class);
    }

    public function navigation()
    {
        $this->belongsTo(NavigationItem::class)->withTrashed();
    }
}
