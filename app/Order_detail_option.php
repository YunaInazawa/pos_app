<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_detail_option extends Model
{
    use SoftDeletes;

    public function order_detail()
    {
        return $this->belongsTo('App\Order_detail');
    }

    public function option()
    {
        return $this->belongsTo('App\Option');
    }
}
