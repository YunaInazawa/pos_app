<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use SoftDeletes;

    public function recipe_details()
    {
        return $this->hasMany('App\Recipe_detail');
    }

    public function order_details()
    {
        return $this->hasMany('App\Order_detail');
    }

    public function recipe_type()
    {
        return $this->belongsTo('App\Recipe_type');
    }
}
