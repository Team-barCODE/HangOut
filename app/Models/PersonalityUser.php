<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalityUser extends Model
{
    //
    protected $fillable = ['user_id', 'hobby_id'];
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'personality_user';

    public function personality()
    {
        return $this->belongsTo('App\Models\Personality');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
