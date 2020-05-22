<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    public function userId()
    {
        return $this->belongsToMany('App\Models\User');
    }

}
