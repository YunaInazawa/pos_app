<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;

    public function recipe_details()
    {
        return $this->hasMany('App\Recipe_detail');
    }

    public function recipe_customs()
    {
        return $this->hasMany('App\Recipe_custom');
    }

    public function material_type()
    {
        return $this->belongsTo('App\Material_type');
    }
}
