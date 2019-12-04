<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function order_details()
    {
        return $this->hasMany('App\Order_detail');
    }

    public function pos()
    {
        return $this->belongsTo('App\Pos');
    }
}
