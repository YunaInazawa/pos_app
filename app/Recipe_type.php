<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe_type extends Model
{
    use SoftDeletes;

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}
