<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
