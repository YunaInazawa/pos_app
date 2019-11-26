<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_type extends Model
{
    use SoftDeletes;

    public function materials()
    {
        return $this->hasMany('App\Material');
    }
}
