<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $guarded;

    public function product()
    {
        $this->belongsTo(Product::class)->withTrashed();
    }
    public function sub_categaory()
    {
        $this->belongsTo(SubCategory::class)->withTrashed();
    }
}
