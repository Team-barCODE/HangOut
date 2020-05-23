<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HobbyUser extends Model
{
    //
    protected $fillable = ['user_id', 'hobby_id'];
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'hobby_user';

    public function hobby()
    {
        return $this->belongsTo('App\Models\Hobby');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
