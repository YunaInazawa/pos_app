<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
