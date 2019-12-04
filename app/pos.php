<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pos extends Model
{
    use SoftDeletes;

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
