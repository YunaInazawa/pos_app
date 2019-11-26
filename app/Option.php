<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use SoftDeletes;

    public function order_detail_options()
    {
        return $this->hasMany('App\Order_detail_option');
    }
}
