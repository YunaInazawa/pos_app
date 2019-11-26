<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;

    public function order_details()
    {
        return $this->hasMany('App\Order_detail');
    }
}
