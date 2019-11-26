<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe_type extends Model
{
    use SoftDeletes;

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}
