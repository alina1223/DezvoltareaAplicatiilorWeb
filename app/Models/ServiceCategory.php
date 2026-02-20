<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['name', 'description', 'slug', 'display_order'];

    // Relație: O categorie are mai multe servicii
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
