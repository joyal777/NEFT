<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'id',
        'cat_name',
        'cat_image', 
        'cat_description', 
        'cat_status',
        'cat_icon'
    ];
    public function property()
    {
        return $this->hasMany(Property::class, 'cat_id');
    }

}
