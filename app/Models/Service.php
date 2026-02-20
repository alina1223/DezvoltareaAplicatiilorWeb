<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'price', 'category_id', 'is_active'];

    // Relație: Un serviciu aparține unei categorii
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
