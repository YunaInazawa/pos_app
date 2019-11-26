<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe_custom extends Model
{
    use SoftDeletes;

    public function material()
    {
        return $this->belongsTo('App\Material');
    }

    public function order_detail()
    {
        return $this->belongsTo('App\Order_detail');
    }
}
