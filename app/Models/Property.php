<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property'; 
    protected $fillable = [
        'id',
        'cat_id',
        'user_id', 
        'prop_name', 
        'prop_image',
        'status',
        'description',
        'features'
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'cat_id');
    }

}
