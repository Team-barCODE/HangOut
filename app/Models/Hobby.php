<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    //
    public function userId()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
