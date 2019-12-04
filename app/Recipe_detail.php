<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe_detail extends Model
{
    use SoftDeletes;

    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    public function material()
    {
        return $this->belongsTo('App\Material');
    }
}
