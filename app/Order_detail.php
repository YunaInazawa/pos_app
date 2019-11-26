<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use SoftDeletes;

    public function order_detail_options()
    {
        return $this->hasMany('App\Order_detail_option');
    }

    public function recipe_customs()
    {
        return $this->hasMany('App\Recipe_custom');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }
}
